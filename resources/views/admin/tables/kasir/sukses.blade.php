@extends('layouts.admin')

@section('title', 'Transaksi Berhasil')

@section('content')
    <div class="min-h-screen bg-gray-900 text-white py-8 px-6">
        <div class="max-w-2xl mx-auto bg-gray-800 rounded-2xl shadow-lg border border-gray-700 p-8 text-center">

            {{-- Icon Success --}}
            <div class="mb-6">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Transaksi Berhasil!</h1>
                <p class="text-gray-400">Pembayaran telah diproses dengan sukses.</p>
            </div>

            {{-- Detail Transaksi --}}
            <div class="bg-gray-900 rounded-lg p-6 mb-6 border border-gray-700">
                <h2 class="text-xl font-semibold text-white mb-4">Detail Transaksi</h2>

                <div class="space-y-3 text-left">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Kode Transaksi:</span>
                        <span class="text-white font-mono">{{ $transaksi->kode_transaksi }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tanggal:</span>
                        <span class="text-white">{{ $transaksi->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Kasir:</span>
                        <span class="text-white">{{ $transaksi->kasir->name ?? 'Admin' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Total:</span>
                        <span class="text-amber-400 font-bold">Rp
                            {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Dibayar:</span>
                        <span class="text-white">Rp {{ number_format($transaksi->uang_dibayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Kembalian:</span>
                        <span class="text-emerald-400 font-bold">Rp
                            {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Daftar Item --}}
            <div class="bg-gray-900 rounded-lg p-6 mb-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Item yang Dibeli</h3>
                <div class="space-y-2">
                    @foreach ($transaksi->items as $item)
                        <div class="flex justify-between items-center py-2 border-b border-gray-700 last:border-b-0">
                            <div class="text-left">
                                <div class="text-white font-medium">{{ $item->produk->name }}</div>
                                <div class="text-gray-400 text-sm">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    × {{ $item->qty }}</div>
                            </div>
                            <div class="text-amber-400 font-semibold">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('admin.kasir.struk', $transaksi->id) }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-amber-500 text-black font-semibold rounded-lg hover:bg-amber-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Lihat Struk
                </a>

                <a href="{{ route('admin.kasir.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Transaksi Baru
                </a>
            </div>
        </div>
    </div>
@endsection
