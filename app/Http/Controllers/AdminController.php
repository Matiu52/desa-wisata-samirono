<?php

namespace App\Http\Controllers;

use App\Models\HomeSetting;
use App\Http\Requests\HomeSettingRequest;
use App\Services\HomeSettingService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(private HomeSettingService $service)
    {
    }

    public function index()
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

    public function edit(HomeSetting $homeSetting)
    {
        $images = $homeSetting->images ? explode(',', $homeSetting->images) : [];
        return view('admin.home.edit', compact('homeSetting', 'images'));
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
}