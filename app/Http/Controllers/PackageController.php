<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\Order;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword', ''));
        $packageQuery = TourPackage::query();
        if ($keyword) {
            $packageQuery = $packageQuery->where('package_name', 'LIKE', '%' . $keyword . '%')->orWhere('duration', 'LIKE', '%' . $keyword . '%');
        }
        $tourPackages = $packageQuery->orderBy('created_at', 'desc')->paginate(9);

        if ($request->ajax()) {
            return response()->json(view('frontend.tour-packages.components.packages', compact('tourPackages'))->render());
        }

        return view('packages', compact('tourPackages', 'keyword'));
    }

    public function showForm($slug)
    {
        $selectedPackage = TourPackage::where('slug', $slug)->firstOrFail();

        return view('frontend.tour-packages.order-form', compact('selectedPackage'));
    }

    public function submitOrder(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'package_id' => 'required|exists:tour_packages,id',
            'notes' => 'nullable|string',
        ]);

        // Simpan data pesanan ke database
        Order::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'package_id' => $validatedData['package_id'],
            'notes' => $validatedData['notes'] ?? null,
        ]);
        return redirect()->route('frontend.tour-packages')->with('success', 'Pesanan Anda berhasil dikirim!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}