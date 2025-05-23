<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $homeAtas = Models\HomeSetting::where('section', 'atas')->get();
        $homeTengah = Models\HomeSetting::where('section', 'tengah')->get();
        $homeBawah = Models\HomeSetting::where('section', 'bawah')->get();
        $backgroundImage = Models\BackgroundSetting::first();
        $carousels = Models\Gallery::with('images')
            ->orderByDesc('created_at') // Mengurutkan dari yang terbaru
            ->get();

        return view('welcome', compact('carousels', 'homeAtas', 'homeTengah', 'homeBawah', 'backgroundImage'));
    }
}
