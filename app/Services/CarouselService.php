<?php

namespace App\Services;

use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarouselService
{
    public function store(array $data, $images)
    {
        foreach ($images as $key => $image) {
            $fileName = time() . $key . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('carousels', $fileName, 'public');

            Carousel::create([
                'user_id' => Auth::id(),
                'image_path' => $imagePath,
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null
            ]);
        }
    }

    public function update(Carousel $carousel, array $data, $images = null)
    {
        if ($images) {
            Storage::disk('public')->delete($carousel->image_path);
            foreach ($images as $key => $image) {
                $fileName = time() . $key . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('carousels', $fileName, 'public');

                $carousel->update([
                    'image_path' => $imagePath,
                    'title' => $data['title'] ?? null,
                    'description' => $data['description'] ?? null
                ]);
            }
        } else {
            $carousel->update([
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null
            ]);
        }
    }
}