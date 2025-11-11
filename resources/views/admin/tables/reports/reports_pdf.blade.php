@extends('layouts.admin')

@section('title', 'Laporan Penjualan PDF')

@section('content')
    <div style="font-family: Arial, sans-serif; padding: 20px;">
        <h1 style="text-align: center; margin-bottom: 20px;">Laporan Penjualan</h1>
        <p style="text-align: center; margin-bottom: 20px;">Periode: {{ $titleRange }}</p>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background-color: #f0f0f0;">
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kode Transaksi</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Kasir</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Tanggal</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Total</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Bayar</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Kembalian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $t)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $t->kode_transaksi }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $t->kasir->name ?? 'N/A' }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ \Carbon\Carbon::parse($t->created_at)->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp
                            {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp
                            {{ number_format($t->uang_dibayar ?? 0, 0, ',', '.') }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">Rp
                            {{ number_format($t->kembalian ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Tidak ada
                            transaksi untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <p><strong>Total Transaksi:</strong> {{ $totalTransactions }}</p>
            <p><strong>Total Penjualan:</strong> Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($totalPayment ?? 0, 0, ',', '.') }}</p>
            <p><strong>Total Kembalian:</strong> Rp {{ number_format($totalChange ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>
@endsection
