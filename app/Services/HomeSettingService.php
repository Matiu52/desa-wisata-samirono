<?php

namespace App\Services;

use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class HomeSettingService
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

    public function getDashboardData(): array
    {
        return [
            'postCount' => \App\Models\Post::count(),
            'tourPackageCount' => \App\Models\TourPackage::count(),
            'commentCount' => \App\Models\Comment::count(),
            'userCount' => \App\Models\User::count(),
            'orderCount' => \App\Models\Order::count(),
            'setting' => HomeSetting::orderByRaw("FIELD(section, 'atas', 'tengah', 'bawah')")->get(),
            'galleries' => \App\Models\Gallery::all(),
            'backgroundImage' => \App\Models\BackgroundSetting::first(),
        ];
    }

    public function create(array $data, Request $request): HomeSetting
    {
        $images = $this->handleCloudinaryUploads($request);

        return HomeSetting::create([
            'section' => $data['section'],
            'title' => $data['title'],
            'content' => $data['content'],
            'images' => implode(',', $images),
        ]);
    }

    public function update(HomeSetting $homeSetting, array $data, Request $request): bool
    {
        $oldImages = $homeSetting->images ? explode(',', $homeSetting->images) : [];
        $newImages = $this->handleCloudinaryUploads($request);

        $combinedImages = array_merge($oldImages, $newImages);

        return $homeSetting->update([
            'section' => $data['section'],
            'title' => $data['title'],
            'content' => $data['content'],
            'images' => implode(',', $combinedImages),
        ]);
    }

    public function deleteImage(HomeSetting $homeSetting, string $imagePublicId): bool
    {
        $images = explode(',', $homeSetting->images);

        if (in_array($imagePublicId, $images)) {
            try {
                // Hapus gambar dari Cloudinary
                $this->uploader->destroy($imagePublicId);

                // Update daftar gambar di database
                $images = array_filter($images, fn($img) => $img !== $imagePublicId);
                return $homeSetting->update(['images' => implode(',', $images)]);
            } catch (\Exception $e) {
                report($e);
                return false;
            }
        }

        return false;
    }

    public function delete(HomeSetting $homeSetting): void
    {
        if ($homeSetting->images) {
            foreach (explode(',', $homeSetting->images) as $imagePublicId) {
                try {
                    $this->uploader->destroy($imagePublicId);
                } catch (\Exception $e) {
                    report($e);
                    continue;
                }
            }
        }

        $homeSetting->delete();
    }

    private function handleCloudinaryUploads(Request $request): array
    {
        $uploadedPublicIds = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $uploadResult = $this->uploader->upload(
                    $image->getRealPath(),
                    [
                        'folder' => 'desa_wisata_samirono/home_settings',
                        'resource_type' => 'image',
                        'transformation' => [
                            'width' => 1200,
                            'height' => 800,
                            'crop' => 'fill',
                            'quality' => 'auto'
                        ]
                    ]
                );

                $uploadedPublicIds[] = $uploadResult['public_id'];
            }
        }

        return $uploadedPublicIds;
    }

    /**
     * Generate URL gambar dari public_id
     */
    public function getImageUrl(string $publicId): string
    {
        return "https://res.cloudinary.com/" . config('cloudinary.cloud_name') .
            "/image/upload/w_1200,h_800,c_fill,q_auto/" . $publicId;
    }
}
