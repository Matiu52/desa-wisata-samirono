<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Auth::user()->carousels;
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $fileName = time() . $key . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('carousels', $fileName, 'public');

                Carousel::create([
                    'user_id' => Auth::id(),
                    'image_path' => $imagePath,
                    'title' => $request->title,
                    'description' => $request->description
                ]);
            }
        }

        return redirect()->route('carousel.index')->with('success', 'Carousels berhasil dibuat.');
    }

    public function edit(Carousel $carousel)
    {
        if ($carousel->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        if ($carousel->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('images')) {
            Storage::disk('public')->delete($carousel->image_path);
            foreach ($request->file('images') as $key => $image) {
                $fileName = time() . $key . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('carousels', $fileName, 'public');

                $carousel->update([
                    'image_path' => $imagePath,
                    'title' => $request->title,
                    'description' => $request->description
                ]);
            }
        } else {
            $carousel->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        }

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil diperbarui.');
    }

    public function destroy(Carousel $carousel)
    {
        if ($carousel->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        Storage::disk('public')->delete($carousel->image_path);
        $carousel->delete();
        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil dihapus.');
    }
}