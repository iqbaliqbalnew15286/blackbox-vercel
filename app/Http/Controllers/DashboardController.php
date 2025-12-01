<?php

namespace App\Http\Controllers;

// Import semua Model yang Anda perlukan
use App\Models\MenuItem;
use App\Models\PromoItem;
use App\Models\GalleryItem;
use App\Models\User;
// Asumsi Anda memiliki model-model ini:
// use App\Models\Order;
// use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk data penjualan

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data
        $menuItemCount = MenuItem::count();
        $activePromosCount = PromoItem::where('is_active', true)
            ->where('end_date', '>=', now())
            ->count();
        $galleryImageCount = GalleryItem::count();

        // Asumsi: Menghitung staf berdasarkan 'role'
        $staffCount = User::where('role', 'staff')->count();

        // Asumsi: Logika untuk data yang mungkin belum Anda miliki
        // Ganti ini dengan logika Anda sendiri
        $newOrdersCount = 0; // Ganti dengan: Order::where('status', 'pending')->count();
        $lowStockItemsCount = 0; // Ganti dengan: MenuItem::where('stock', '<', 10)->count();
        $pendingReviewsCount = 0; // Ganti dengan: Review::where('is_approved', false)->count();

        // Asumsi: Logika untuk total penjualan hari ini
        $todaySalesTotal = 0; // Ganti dengan: Order::whereDate('created_at', today())->sum('total_price');

        // 2. Format data (opsional, tapi bagus untuk penjualan)
        $formattedSales = 'Rp ' . number_format($todaySalesTotal, 0, ',', '.');


        // 3. Kirim semua data ke view
        return view('caffesalon.admin.dashboard', [
            'menuItemCount' => $menuItemCount,
            'newOrdersCount' => $newOrdersCount,
            'lowStockItemsCount' => $lowStockItemsCount,
            'activePromosCount' => $activePromosCount,
            'staffCount' => $staffCount,
            'galleryImageCount' => $galleryImageCount,
            'pendingReviewsCount' => $pendingReviewsCount,
            'todaySalesTotal' => $formattedSales
        ]);
    }
}
