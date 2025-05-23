<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;

class GalleryService
{
    protected UploadApi $uploader;

    public function __construct()
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $this->uploader = new UploadApi();
    }

    public function getGalleriesData(): array
    {
        return [
            'galleries' => Gallery::select('id', 'title', 'description', 'created_at')
                ->with('images:id,gallery_id,image_path,public_id')
                ->get(),
        ];
    }

    public function storeWithImages(array $data): Gallery
    {
        $gallery = Gallery::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($data['images'] as $key => $image) {
            if ($image instanceof UploadedFile && $image->isValid()) {
                $uploaded = $this->uploader->upload($image->getRealPath(), [
                    'folder' => 'desa_wisata_samirono/gallery',
                    'public_id' => 'gallery_' . time() . '_' . $key,
                ]);

                $gallery->images()->create([
                    'image_path' => $uploaded['secure_url'],
                    'public_id' => $uploaded['public_id'] ?? null,
                ]);
            }
        }

        return $gallery;
    }

    public function updateGallery(Gallery $gallery, array $data, array $images = [], array $deleteImageIds = []): Gallery
    {
        if (!empty($deleteImageIds)) {
            $imagesToDelete = GalleryImage::whereIn('id', $deleteImageIds)->get();

            foreach ($imagesToDelete as $image) {
                if (!empty($image->public_id)) {
                    $this->uploader->destroy($image->public_id);
                }

                $image->delete();
            }
        }

        $gallery->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($images as $key => $image) {
            if ($image instanceof UploadedFile && $image->isValid()) {
                $uploaded = $this->uploader->upload($image->getRealPath(), [
                    'folder' => 'desa_wisata_samirono/gallery',
                    'public_id' => 'gallery_' . time() . '_' . $key,
                ]);

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $uploaded['secure_url'],
                    'public_id' => $uploaded['public_id'] ?? null,
                    'caption' => null,
                ]);
            }
        }

        return $gallery->fresh('images');
    }

    public function deleteGallery(Gallery $gallery): void
    {
        foreach ($gallery->images as $image) {
            if (!empty($image->public_id)) {
                $this->uploader->destroy($image->public_id);
            }

            $image->delete();
        }

        $gallery->delete();
    }
}
