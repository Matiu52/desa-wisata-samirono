<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Menampilkan notifikasi pesanan pengguna.
     */
    public function getUserOrders()
    {
        // Ambil pesanan pengguna yang sedang login
        $orders = Order::where('user_id', 2)
            ->latest()
            ->take(5)
            ->get();

        // Hitung jumlah pesanan
        $orderCount = $orders->count();

        // Kirim data ke view atau JSON
        return response()->json([
            'orders' => $orders,
            'orderCount' => $orderCount,
        ]);
    }
}
