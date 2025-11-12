<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $trx->kode_transaksi }}</title>
    <style>
        /* Gaya thermal printer */
        body {
            font-family: 'Consolas', monospace;
            font-size: 10px;
            width: 300px;
            /* ±80mm */
            margin: 0 auto;
            padding: 10px;
            color: #000;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        img.logo {
            width: 60px;
            height: auto;
            margin-bottom: 5px;
        }

        .header h1 {
            font-size: 14px;
            margin: 3px 0 0 0;
        }

        .header p {
            margin: 1px 0;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 2px 0;
        }

        th {
            text-align: left;
        }

        .total-row {
            font-weight: bold;
            font-size: 11px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    {{-- ✅ HEADER --}}
    <div class="header text-center">
        {{-- Logo Caffe Warghe (ubah src sesuai logo kamu di public/images/logo.png misalnya) --}}
        <img src="{{ asset('images/logo.png') }}" alt="Logo Caffe Warghe" class="logo">
        <h1>CAFFE WARGHE</h1>
        <p>Jl. Kopi Hangat No. 42, Kota Cimahi</p>
        <p>Telp: 0812-3456-7890</p>
    </div>

    <div class="divider"></div>

    {{-- ✅ INFORMASI TRANSAKSI --}}
    <table>
        <tr>
            <td>No. Transaksi</td>
            <td>:</td>
            <td>{{ $trx->kode_transaksi }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($trx->created_at)->translatedFormat('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>:</td>
            <td>{{ $trx->kasir->name ?? 'Admin' }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    {{-- ✅ DAFTAR ITEM --}}
    <table>
        @foreach ($trx->items as $item)
            <tr>
                <td colspan="3">{{ $item->produk->name ?? 'Produk dihapus' }}</td>
            </tr>
            <tr>
                <td class="text-left">@ {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td class="text-center">x{{ $item->qty }}</td>
                <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="divider"></div>

    {{-- ✅ TOTAL RINGKASAN --}}
    <table>
        <tr class="total-row">
            <td colspan="2">TOTAL</td>
            <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2">DIBAYAR</td>
            <td class="text-right">Rp {{ number_format($trx->uang_dibayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2">KEMBALIAN</td>
            <td class="text-right">Rp {{ number_format($trx->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    {{-- ✅ FOOTER --}}
    <div class="text-center">
        <p>Terima kasih telah berkunjung ☕</p>
        <p style="font-size: 8px;">Harga sudah termasuk pajak</p>
        <p style="font-size: 9px;">Semoga harimu menyenangkan!</p>
    </div>

    {{-- ✅ TOMBOL AKSI (tidak dicetak) --}}
    <div class="text-center no-print" style="margin-top: 15px;">
        <button onclick="window.print()"
            style="padding: 7px 15px; background-color: #0a1d3b; color: white; border: none; border-radius: 5px; cursor: pointer;">
            🖨️ Cetak Struk
        </button>
        <a href="{{ route('admin.kasir.index') }}"
            style="padding: 7px 15px; background-color: #b76e41; color: white; border-radius: 5px; text-decoration: none; margin-left: 8px;">
            ⬅️ Transaksi Baru
        </a>
    </div>

    {{-- ✅ CETAK OTOMATIS --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.print();
        });
    </script>

</body>

</html>
