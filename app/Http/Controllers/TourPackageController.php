<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\TourPackageImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class TourPackageController extends Controller
{
    protected $uploader;

    public function __construct()
    {
        // Setup konfigurasi Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret')
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        $this->uploader = new UploadApi();
    }

    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword', ''));
        $tourPackages = TourPackage::query();

        if ($keyword) {
            $tourPackages = $tourPackages->where('package_name', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhere('price', 'LIKE', '%' . $keyword . '%');
        }

        $tourPackages = $tourPackages->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return response()->json(view('admin.tour-packages.components.table-package', compact('tourPackages'))->render());
        }

        return view('admin.tour-packages.index', compact('tourPackages', 'keyword'));
    }

    public function create()
    {
        return view('admin.tour-packages.create');
    }

    private function createUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (DB::table('tour_packages')->where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    public function store(Request $request)
    {
        $request->validate([
            'packageName' => 'required',
            'duration' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'listItems' => 'array',
            'listItems.*' => 'string',
        ]);

        DB::beginTransaction();

        try {
            $uniqueSlug = $this->createUniqueSlug($request->packageName);

            $tourPackage = TourPackage::create([
                'package_name' => $request->packageName,
                'duration' => $request->duration,
                'price' => $request->price,
                'description' => $request->description,
                'slug' => $uniqueSlug,
                'user_id' => Auth::id(),
            ]);

            // Upload gambar ke Cloudinary
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $uploadResult = $this->uploader->upload(
                        $image->getRealPath(),
                        [
                            'folder' => 'desa_wisata_samirono/tour_packages',
                            'resource_type' => 'image',
                            'transformation' => [
                                'width' => 1200,
                                'height' => 800,
                                'crop' => 'fill',
                                'quality' => 'auto'
                            ]
                        ]
                    );

                    TourPackageImage::create([
                        'tour_package_id' => $tourPackage->id,
                        'image_path' => $uploadResult['public_id'],
                        'image_url' => $uploadResult['secure_url']
                    ]);
                }
            }

            foreach ($request->listItems as $item) {
                $tourPackage->listItems()->create(['name' => $item]);
            }

            DB::commit();

            return redirect()->route('tour-packages.index')->with('success', 'Paket wisata berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat paket wisata: ' . $e->getMessage());
        }
    }

    public function show(TourPackage $tourPackage)
    {
        return view('admin.tour-packages.show', compact('tourPackage'));
    }

    public function edit(TourPackage $tourPackage)
    {
        $tourPackage = TourPackage::where('slug', $tourPackage->slug)->firstOrFail();
        return view('admin.tour-packages.edit', compact('tourPackage'));
    }

    public function update(Request $request, TourPackage $tourPackage)
    {
        $request->validate([
            'packageName' => 'required',
            'duration' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'new_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'listItems' => 'required|array',
            'listItems.*' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $tourPackage->update([
                'package_name' => $request->packageName,
                'duration' => $request->duration,
                'price' => $request->price,
                'description' => $request->description,
                'slug' => Str::slug($request->packageName),
            ]);

            // Tambah gambar baru
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $image) {
                    $uploadResult = $this->uploader->upload(
                        $image->getRealPath(),
                        [
                            'folder' => 'desa_wisata_samirono/tour_packages',
                            'resource_type' => 'image',
                            'transformation' => [
                                'width' => 1200,
                                'height' => 800,
                                'crop' => 'fill',
                                'quality' => 'auto'
                            ]
                        ]
                    );

                    TourPackageImage::create([
                        'tour_package_id' => $tourPackage->id,
                        'image_path' => $uploadResult['public_id'],
                        'image_url' => $uploadResult['secure_url']
                    ]);
                }
            }

            $tourPackage->listItems()->delete();
            foreach ($request->listItems as $item) {
                if (!empty($item)) {
                    $tourPackage->listItems()->create(['name' => $item]);
                }
            }

            DB::commit();

            return redirect()->route('tour-packages.index')->with('success', 'Paket wisata berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengupdate paket wisata: ' . $e->getMessage());
        }
    }

    public function destroyImage(TourPackageImage $image)
    {
        try {
            $this->uploader->destroy($image->image_path);
            $image->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function destroy(TourPackage $tourPackage)
    {
        DB::beginTransaction();

        try {
            // Hapus gambar dari Cloudinary
            foreach ($tourPackage->images as $image) {
                $this->uploader->destroy($image->image_path);
            }

            $tourPackage->delete();

            DB::commit();

            return redirect()->route('tour-packages.index')->with('success', 'Paket wisata berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus paket wisata: ' . $e->getMessage());
        }
    }
}
