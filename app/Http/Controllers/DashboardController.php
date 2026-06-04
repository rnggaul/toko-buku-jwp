<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ringkasan Box Utama
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        
        // Menghitung total kuantitas barang masuk dan keluar
        $totalStockIn = StockTransaction::where('type', 'masuk')->sum('quantity');
        $totalStockOut = StockTransaction::where('type', 'keluar')->sum('quantity');

        // 2. Transaksi Terbaru (Mengambil 5 data terakhir)
        $latestTransactions = StockTransaction::with(['product', 'user'])
            ->orderBy('transaction_date', 'desc')
            ->latest()
            ->take(5)
            ->get();

        // 3. Menampilkan 5 Stok Terendah (< 10) & 5 Stok Tertinggi (>= 10)
        $topMinProducts = Product::with('category')
            ->where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $topMaxProducts = Product::with('category')
            ->where('stock', '>=', 10)
            ->orderBy('stock', 'desc')
            ->take(5)
            ->get();

        // 4. Data Grafik Line Chart (Transaksi Bulan Ini)
        $monthlyTransactions = StockTransaction::select(
                DB::raw('DATE_FORMAT(transaction_date, "%d-%m-%Y") as formatted_date'),
                DB::raw('transaction_date'),
                DB::raw("SUM(CASE WHEN type = 'masuk' THEN quantity ELSE 0 END) as total_in"),
                DB::raw("SUM(CASE WHEN type = 'keluar' THEN quantity ELSE 0 END) as total_out")
            )
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->groupBy('formatted_date', 'transaction_date')
            ->orderBy('transaction_date', 'asc')
            ->get();

        // Memecah data untuk kebutuhan Chart.js
        $chartLabels = $monthlyTransactions->pluck('formatted_date');
        $chartIn = $monthlyTransactions->pluck('total_in');
        $chartOut = $monthlyTransactions->pluck('total_out');

        // Kirim semua variabel ke view dashboard
        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'latestTransactions',
            'topMinProducts',
            'topMaxProducts',
            'chartLabels',
            'chartIn',
            'chartOut'
        ));
    }
}