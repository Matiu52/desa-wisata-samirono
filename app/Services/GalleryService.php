<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function getGalleriesData(): array
    {
        return [
            'galleries' => Gallery::select('id', 'title', 'description', 'created_at')
                ->with('images:id,gallery_id,image_path') // Memuat relasi gambar
                ->get(),
        ];
    }
    public function storeWithImages(array $data): Gallery
    {
        $gallery = Gallery::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($data['images'] as $image) {
            $path = $image->store('gallery', 'public');
            $gallery->images()->create([
                'image_path' => $path,
            ]);
        }

        return $gallery;
    }
    public function updateGallery(Gallery $gallery, array $data, array $images = [], array $deleteImageIds = []): Gallery
    {
        if (!empty($deleteImageIds)) {
            $imagesToDelete = GalleryImage::whereIn('id', $deleteImageIds)->get();

            foreach ($imagesToDelete as $image) {
                $imagePath = public_path('images/uploads/' . $image->image_path);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $image->delete();
            }
        }


        $gallery->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($images as $image) {
            if ($image instanceof UploadedFile && $image->isValid()) {
                $path = $image->store('gallery', 'public');

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path,
                    'caption' => null,
                ]);
            }
        }

        return $gallery->fresh('images');
    }

    public function deleteGallery(Gallery $gallery): void
    {
        foreach ($gallery->images as $image) {
            $imagePath = public_path('images/uploads/' . $image->image_path);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image->delete();
        }

        $gallery->delete();
    }
}
