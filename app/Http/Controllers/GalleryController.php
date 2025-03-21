<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\StoreGalleryWithImagesRequest;
use App\Http\Requests\Gallery\UpdateGalleryRequest;
use App\Http\Requests\Gallery\DeleteGalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    public function __construct(protected GalleryService $service)
    {
    }

    public function index()
    {
        // $galleries = Gallery::latest()->get();
        // return view('dashboard', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(StoreGalleryWithImagesRequest $request)
    {
        $this->service->storeWithImages($request->validated());
        return redirect()->route('dashboard')->with('success', 'Gallery berhasil dibuat.');
    }

    public function edit(Gallery $gallery)
    {
        $gallery->load('images');
        return view('admin.gallery.edit', compact('gallery'));
    }


    public function update(UpdateGalleryRequest $request, Gallery $gallery, GalleryService $service)
    {
        $data = $request->validated();

        $deleteImageIds = $request->input('delete_images', []);

        $service->updateGallery(
            $gallery,
            $data,
            $request->file('images', []),
            $deleteImageIds
        );

        return redirect()->route('dashboard')
            ->with('success', 'Galeri berhasil diperbarui!');
    }


    public function destroy(DeleteGalleryRequest $request, Gallery $gallery, GalleryService $service)
    {
        $service->deleteGallery($gallery);

        return redirect()->route('dashboard')->with('success', 'Galeri berhasil dihapus.');
    }

}