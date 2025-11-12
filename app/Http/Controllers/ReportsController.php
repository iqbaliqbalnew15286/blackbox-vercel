<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // ✅ Tetapkan periode laporan default (bulanan)
        $period = 'monthly';

        // ✅ Ambil awal dan akhir bulan ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $titleRange = $startDate->format('F Y');

        // ✅ Ambil semua transaksi bulan ini (semua kasir)
        $transaksis = Transaksi::whereBetween('created_at', [$startDate, $endDate])
            ->with(['kasir', 'items.menu'])
            ->get();

        // ✅ Hitung ringkasan utama
        $totalSales = $transaksis->sum('total_harga');
        $totalTransactions = $transaksis->count();
        $totalPayment = $transaksis->sum('uang_dibayar');
        $totalChange = $transaksis->sum('kembalian');

        $daysInPeriod = $startDate->diffInDays($endDate) + 1;
        $avgSalesPerDay = $daysInPeriod > 0 ? $totalSales / $daysInPeriod : 0;

        // ✅ Rekap per hari
        $perDay = $transaksis->groupBy(function ($item) {
            return $item->created_at->format('d/m/Y');
        })->map(function ($group) {
            return [
                'date' => $group->first()->created_at->format('d/m/Y'),
                'count' => $group->count(),
                'sum_sales' => $group->sum('total_harga'),
                'sum_payment' => $group->sum('uang_dibayar'),
                'sum_change' => $group->sum('kembalian'),
            ];
        })->values();

        // ✅ Top 10 menu paling laku bulan ini
        $topMenus = TransaksiItem::whereHas('transaksi', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->with('menu')
            ->select('menu_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('menu_id')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->menu->name ?? 'Unknown',
                    'qty' => $item->total_qty,
                ];
            });

        // ✅ Chart penjualan per hari di bulan ini
        $chartLabels = [];
        $chartSales = [];

        $current = $startDate->copy();
        while ($current <= $endDate) {
            $sales = $transaksis
                ->whereBetween('created_at', [$current->copy()->startOfDay(), $current->copy()->endOfDay()])
                ->sum('total_harga');
            $chartLabels[] = $current->format('d/m');
            $chartSales[] = $sales;
            $current->addDay();
        }

        // ✅ Kirim semua data ke view
        return view('admin.tables.reports.reports', compact(
            'period',
            'titleRange',
            'totalSales',
            'totalTransactions',
            'totalPayment',
            'totalChange',
            'avgSalesPerDay',
            'perDay',
            'topMenus',
            'transaksis',
            'chartLabels',
            'chartSales'
        ));
    }
}
