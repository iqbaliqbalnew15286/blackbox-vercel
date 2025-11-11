<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            margin-top: 20px;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <h1>Laporan Penjualan</h1>
    <p style="text-align: center;">Periode: {{ $titleRange }}</p>

    <table>
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th class="text-right">Total</th>
                <th class="text-right">Bayar</th>
                <th class="text-right">Kembalian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $t)
                <tr>
                    <td>{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->kasir->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->created_at)->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
                    <td class="text-right">Rp {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($t->uang_dibayar ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($t->kembalian ?? 0, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada transaksi untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Transaksi:</strong> {{ $totalTransactions }}</p>
        <p><strong>Total Penjualan:</strong> Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}</p>
        <p><strong>Total Pembayaran:</strong> Rp {{ number_format($totalPayment ?? 0, 0, ',', '.') }}</p>
        <p><strong>Total Kembalian:</strong> Rp {{ number_format($totalChange ?? 0, 0, ',', '.') }}</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
