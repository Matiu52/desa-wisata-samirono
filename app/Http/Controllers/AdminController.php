<?php

namespace App\Http\Controllers;

use App\Models\HomeSetting;

use Illuminate\Http\Request;
use App\Services\HomeSettingService;
use App\Http\Requests\HomeSettingRequest;
use App\Services\HomeSettings\SearchService;

use App\Http\Requests\SearchHomeSetting\SearchGalleryRequest;
use App\Http\Requests\SearchHomeSetting\SearchSectionRequest;

class AdminController extends Controller
{
    public function __construct(private HomeSettingService $service) {}

    public function index(Request $request)
    {
        $data = $this->service->getDashboardData();
        return view('admin.dashboard', $data);
    }

    public function create()
    {
        return view('admin.home.create');
    }

    public function store(HomeSettingRequest $request)
    {
        $this->service->create($request->validated(), $request);
        return redirect()->route('dashboard')->with('success', 'Section berhasil ditambahkan.');
    }

    public function edit(HomeSetting $homeSetting, HomeSettingService $service)
    {
        $imagesFormat = [];
        $images = $homeSetting->images ? explode(',', $homeSetting->images) : [];
        foreach ($images as $image) {
            $imagesFormat[] = $service->getImageUrl($image);
        }
        return view('admin.home.edit', compact('homeSetting', 'imagesFormat'));
    }

    public function update(HomeSettingRequest $request, HomeSetting $homeSetting)
    {
        $this->service->update($homeSetting, $request->validated(), $request);
        return redirect()->route('dashboard')->with('success', 'Section berhasil diperbarui.');
    }

    public function deleteImage(Request $request, HomeSetting $homeSetting)
    {
        $image = $request->input('image');
        $this->service->deleteImage($homeSetting, $image);
        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    public function destroy(HomeSetting $homeSetting)
    {
        $this->service->delete($homeSetting);
        return redirect()->route('dashboard')->with('success', 'Section berhasil dihapus.');
    }

    public function searchSection(SearchSectionRequest $request, SearchService $service)
    {
        $query = $request->input('q');

        if ($request->ajax()) {
            $sections = $service->searchSections($query);
            $html = view('components.admin.partials.section-body', ['setting' => $sections])->render();

            return response()->json(['html' => $html]);
        }

        return redirect()->route('dashboard');
    }

    public function searchGallery(SearchGalleryRequest $request, SearchService $service)
    {
        $query = $request->input('q');

        if ($request->ajax()) {
            $galleries = $service->searchGalleries($query);
            $html = view('components.admin.partials.gallery-body', [
                'galleries' => $galleries,
                'galleryCount' => $galleries->count(),
            ])->render();

            return response()->json(['html' => $html]);
        }

        return redirect()->route('dashboard');
    }
}
