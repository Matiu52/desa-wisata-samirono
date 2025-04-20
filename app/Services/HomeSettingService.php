<?php

namespace App\Services;

use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSettingService
{
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
        ];
    }

    public function create(array $data, Request $request): HomeSetting
    {
        // Tangani upload gambar
        $images = $this->handleImages($request);

        // Buat data baru di database
        return HomeSetting::create([
            'section' => $data['section'],
            'title' => $data['title'],
            'content' => $data['content'],
            'images' => implode(',', $images), // Gabungkan array gambar menjadi string
        ]);
    }

    public function update(HomeSetting $homeSetting, array $data, Request $request): bool
    {
        $oldImages = $homeSetting->images ? explode(',', $homeSetting->images) : [];
        $newImages = $this->handleImages($request);

        $combinedImages = array_merge($oldImages, $newImages);

        return $homeSetting->update([
            'section' => $data['section'],
            'title' => $data['title'],
            'content' => $data['content'],
            'images' => implode(',', $combinedImages),
        ]);
    }


    public function deleteImage(HomeSetting $homeSetting, string $image): bool
    {
        $images = explode(',', $homeSetting->images);
        if (in_array($image, $images)) {
            Storage::disk('public')->delete($image);
            $images = array_filter($images, fn($img) => $img !== $image);
            return $homeSetting->update(['images' => implode(',', $images)]);
        }
        return false;
    }

    public function delete(HomeSetting $homeSetting): void
    {
        if ($homeSetting->images) {
            foreach (explode(',', $homeSetting->images) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $homeSetting->delete();
    }

    private function handleImages(Request $request): array
    {
        $imagePathList = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $fileName = time() . $key . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('home', $fileName, 'public');
                $imagePathList[] = $imagePath;
            }
        }

        return $imagePathList;
    }
}
