<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\TourPackageImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TourPackageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword', ''));
        $tourPackages = TourPackage::query();
        if ($keyword) {
            $tourPackages = $tourPackages->where('package_name', 'LIKE', '%' . $keyword . '%')->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })->orWhere('price', 'LIKE', '%' . $keyword . '%');
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
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'listItems' => 'array',
            'listItems.*' => 'string',
        ]);

        $uniqueSlug = $this->createUniqueSlug($request->packageName);
        $tourPackage = TourPackage::create([
            'package_name' => $request->packageName,
            'duration' => $request->duration,
            'price' => $request->price,
            'description' => $request->description,
            'slug' => $uniqueSlug,
            'user_id' => Auth::id(),
        ]);
        // Simpan Gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tour_packages', 'public');
                TourPackageImage::create([
                    'tour_package_id' => $tourPackage->id,
                    'image_path' => $path,
                ]);
            }
        }
        foreach ($request->listItems as $item) {
            $tourPackage->listItems()->create(['name' => $item]);
        }

        return redirect()->route('tour-packages.index')->with('success', 'Paket wisata berhasil dibuat.');
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
            'listItems' => 'required|array',
            'listItems.*' => 'nullable|string',
        ]);

        $tourPackage = TourPackage::findOrFail($tourPackage->id);
        $tourPackage->update([
            'package_name' => $request->packageName,
            'duration' => $request->duration,
            'price' => $request->price,
            'description' => $request->description,
            'slug' => Str::slug($request->packageName),
        ]);

        $tourPackage->listItems()->delete();
        foreach ($request->listItems as $item) {
            if (!empty($item)) {
                $tourPackage->listItems()->create(['name' => $item]);
            }
        }
        return redirect()->route('tour-packages.index')->with('success', 'Paket wisata berhasil diupdate.');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function destroy(TourPackage $tourPackage)
    {
        $tourPackage->delete();
        return redirect()->route('tour-packages.index')->with('success', 'Paket wisata berhasil dihapus.');
    }
}
