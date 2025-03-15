<?php

namespace App\Http\Controllers;

use App\Http\Requests\Carousel\StoreCarouselRequest;
use App\Http\Requests\Carousel\UpdateCarouselRequest;
use App\Models\Carousel;
use App\Services\CarouselService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    protected $carouselService;

    public function __construct(CarouselService $carouselService)
    {
        $this->carouselService = $carouselService;
    }

    public function index()
    {
        $carousels = Auth::user()->carousels;
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(StoreCarouselRequest $request)
    {
        $this->carouselService->store($request->validated(), $request->file('images'));
        return redirect()->route('carousel.index')->with('success', 'Carousels berhasil dibuat.');
    }

    public function edit(Carousel $carousel)
    {
        if ($carousel->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(UpdateCarouselRequest $request, Carousel $carousel)
    {
        if ($carousel->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->carouselService->update($carousel, $request->validated(), $request->file('images'));
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