<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KasirController extends Controller
{
    /**
     * Menampilkan halaman POS Kasir.
     */
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('admin.tables.kasir.index', compact('menuItems'));
    }

    /**
     * Simpan transaksi baru dan redirect berdasarkan action.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kasir_id' => 'required|exists:users,id',
            'total_belanja' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric',
            'cart_items' => 'required|json',
            'action' => 'required|in:sukses,struk'
        ]);

        $total = $request->total_belanja;
        $bayar = $request->jumlah_bayar;

        if ($bayar < $total) {
            return redirect()->back()->withErrors(['jumlah_bayar' => 'Jumlah bayar kurang dari total belanja.']);
        }

        $kembalian = $bayar - $total;

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX' . now()->format('YmdHis') . Str::upper(Str::random(3)),
            'total_harga' => $total,
            'uang_dibayar' => $bayar,
            'kembalian' => $kembalian,
            'kasir_id' => $request->kasir_id,
        ]);

        // Simpan detail item
        $cart = json_decode($request->cart_items, true);
        if ($cart && is_array($cart)) {
            foreach ($cart as $item) {
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['id'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['price'],
                    'subtotal' => $item['price'] * $item['qty'],
                ]);
            }
        }

        // Redirect berdasarkan action
        if ($request->action === 'struk') {
            return redirect()->route('admin.kasir.struk', ['id' => $transaksi->id])
                ->with('success', 'Transaksi berhasil! Struk otomatis ditampilkan.');
        } else {
            return redirect()->route('admin.kasir.sukses', ['id' => $transaksi->id])
                ->with('success', 'Transaksi berhasil! Halaman sukses ditampilkan.');
        }
    }

    /**
     * Tampilkan struk transaksi.
     */
    public function struk($id)
    {
        $transaksi = Transaksi::with(['items.produk', 'kasir'])->findOrFail($id);
        return view('kasir.struk', ['trx' => $transaksi]);
    }

    /**
     * Tampilkan halaman sukses transaksi.
     */
    public function sukses($id)
    {
        $transaksi = Transaksi::with(['items.produk', 'kasir'])->findOrFail($id);
        return view('kasir.sukses', ['transaksi' => $transaksi]);
    }

    /**
     * API untuk menambahkan item ke cart (opsional jika ingin ajax)
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'qty' => 'nullable|integer|min:1'
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $qty = $request->qty ?? 1;

        return response()->json([
            'id' => $produk->id,
            'name' => $produk->nama_produk,
            'price' => $produk->harga,
            'qty' => $qty,
        ]);
    }

    /**
     * Change active kasir via AJAX
     */
    public function changeKasir(Request $request)
    {
        $request->validate([
            'kasir_id' => 'required|exists:users,id'
        ]);

        $kasir = \App\Models\User::findOrFail($request->kasir_id);

        // Store in session
        session(['active_kasir_id' => $kasir->id]);

        return response()->json([
            'success' => true,
            'kasir' => [
                'id' => $kasir->id,
                'name' => $kasir->name
            ]
        ]);
    }
}
