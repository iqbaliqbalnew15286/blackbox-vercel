@extends('layouts.admin-app')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-amber-400 tracking-tight drop-shadow-sm">Laporan Penjualan</h2>
        <p class="text-gray-300">
            Ringkasan transaksi
            {{ $period === 'daily' ? 'harian' : ($period === 'weekly' ? 'mingguan' : 'bulanan') }} —
            <span class="font-medium text-white">{{ $titleRange }}</span>
        </p>
    </div>

    {{-- 🔍 Filter Form --}}
    <div
        class="bg-gradient-to-br from-gray-900 via-blue-900 to-black p-6 rounded-2xl shadow-xl border border-blue-800 mb-6">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="period" class="block text-sm font-medium text-gray-300">Periode</label>
                <select name="period" id="period"
                    class="mt-1 block w-full rounded-lg bg-gray-800 border border-gray-700 text-white shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    <option value="daily" {{ ($period ?? '') === 'daily' ? 'selected' : '' }}>Harian</option>
                    <option value="weekly" {{ ($period ?? '') === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ ($period ?? '') === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-300">Tanggal</label>
                <input type="date" name="date" id="date" value="{{ $date ?? '' }}"
                    class="mt-1 block w-full rounded-lg bg-gray-800 border border-gray-700 text-white shadow-sm focus:border-amber-500 focus:ring-amber-500">
            </div>

            <div>
                <label for="kasir_id" class="block text-sm font-medium text-gray-300">Filter Kasir</label>
                <select name="kasir_id" id="kasir_id"
                    class="mt-1 block w-full rounded-lg bg-gray-800 border border-gray-700 text-white shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    <option value="">Semua Kasir</option>
                    @foreach (\App\Models\User::where('role', 'kasir')->get() as $kasir)
                        <option value="{{ $kasir->id }}" {{ ($kasirId ?? '') == $kasir->id ? 'selected' : '' }}>
                            {{ $kasir->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 text-white px-6 py-3 rounded-xl hover:from-amber-600 hover:to-amber-700 focus:ring-2 focus:ring-amber-500 font-semibold transition shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-4.35-4.35M18 10.5A7.5 7.5 0 1 1 3 10.5a7.5 7.5 0 0 1 15 0Z" />
                    </svg>
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- 📊 Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        @php
            $cards = [
                ['title' => 'Total Penjualan', 'value' => number_format($totalSales ?? 0, 0, ',', '.'), 'color' => 'emerald'],
                ['title' => 'Total Transaksi', 'value' => $totalTransactions ?? 0, 'color' => 'blue'],
                ['title' => 'Total Pembayaran', 'value' => number_format($totalPayment ?? 0, 0, ',', '.'), 'color' => 'purple'],
                ['title' => 'Total Kembalian', 'value' => number_format($totalChange ?? 0, 0, ',', '.'), 'color' => 'orange'],
                ['title' => 'Rata-rata Penjualan/Hari', 'value' => number_format($avgSalesPerDay ?? 0, 0, ',', '.'), 'color' => 'cyan'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div
                class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-6 rounded-2xl shadow-xl border border-gray-700 hover:scale-[1.02] transition-all duration-300">
                <h3 class="text-sm font-medium text-gray-400">{{ $card['title'] }}</h3>
                <p class="mt-1 text-3xl font-extrabold text-{{ $card['color'] }}-400">
                    Rp {{ $card['value'] }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- 📈 Grafik Penjualan --}}
    <div
        class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 rounded-2xl shadow-xl border border-blue-800 p-6 mb-6">
        <h3 class="text-lg font-semibold text-white mb-4">Grafik Total Penjualan ({{ $titleRange }})</h3>
        <canvas id="salesChart" height="110"></canvas>
    </div>

    {{-- 🏆 Top Produk Terjual --}}
    @if (!empty($topProducts) && count($topProducts) > 0)
        <div
            class="bg-gradient-to-br from-gray-900 via-gray-800 to-black rounded-2xl shadow-xl border border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold text-white mb-4">Top Produk Terjual</h3>
            <div class="space-y-3">
                @foreach ($topProducts as $index => $produk)
                    <div class="flex items-center justify-between py-2 border-b border-gray-700 last:border-b-0">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-amber-400">{{ $index + 1 }}</span>
                            <span class="text-gray-200">{{ $produk['nama'] }}</span>
                        </div>
                        <span class="text-gray-400">{{ $produk['qty'] }} terjual</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- 🗓️ Rekap per Hari --}}
    <div
        class="bg-gradient-to-br from-blue-950 via-blue-900 to-blue-950 rounded-2xl shadow-xl border border-blue-800 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-blue-800">
            <h3 class="text-lg font-semibold text-white">Rekap per Hari</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-blue-800">
                <thead class="bg-blue-900/80">
                    <tr>
                        @foreach (['Hari', 'Transaksi', 'Total Penjualan', 'Total Pembayaran', 'Total Kembalian'] as $head)
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                {{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-blue-950 divide-y divide-blue-800">
                    @forelse($perDay ?? [] as $d)
                        <tr class="hover:bg-blue-900/60">
                            <td class="px-6 py-3 text-sm text-white">{{ $d['date'] ?? '-' }}</td>
                            <td class="px-6 py-3 text-sm text-right text-white">{{ $d['count'] ?? 0 }}</td>
                            <td class="px-6 py-3 text-sm text-right text-emerald-400">Rp
                                {{ number_format($d['sum_sales'] ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-purple-400">Rp
                                {{ number_format($d['sum_payment'] ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-orange-400">Rp
                                {{ number_format($d['sum_change'] ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-blue-300">Tidak ada data pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 🧾 Detail Transaksi --}}
    <div
        class="bg-gradient-to-br from-gray-900 via-gray-800 to-black rounded-2xl shadow-xl border border-gray-700 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-white">Detail Transaksi ({{ $titleRange }})</h3>
            <div class="flex items-center gap-2">
                @foreach ([['route' => 'excel', 'color' => 'green', 'label' => 'Excel'], ['route' => 'pdf', 'color' => 'red', 'label' => 'PDF'], ['route' => 'print', 'color' => 'blue', 'label' => 'Print']] as $btn)
                    <a href="#"
                        class="inline-flex items-center gap-2 bg-{{ $btn['color'] }}-600 text-white px-4 py-2 rounded-lg hover:bg-{{ $btn['color'] }}-700 text-sm font-medium transition shadow-md"
                        onclick="alert('Fitur {{ $btn['label'] }} sedang dalam pengembangan')">
                        {{ $btn['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/80">
                    <tr>
                        @foreach (['Kode', 'Kasir', 'Tanggal', 'Total', 'Bayar', 'Kembalian'] as $head)
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    @forelse($transaksis ?? [] as $t)
                        <tr class="hover:bg-gray-800/80 transition">
                            <td class="px-6 py-3 text-sm font-medium text-amber-400">
                                <a href="{{ route('admin.kasir.struk', $t->id) }}" class="hover:underline">{{ $t->kode_transaksi }}</a>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-300">{{ $t->kasir->name ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-sm text-gray-300">
                                {{ \Carbon\Carbon::parse($t->created_at)->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-right text-white">Rp {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-white">Rp {{ number_format($t->uang_dibayar ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-white">Rp {{ number_format($t->kembalian ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-400">Tidak ada transaksi untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels ?? []),
                    datasets: [{
                        label: 'Total Penjualan',
                        data: @json($chartSales ?? []),
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245,158,11,0.15)',
                        borderWidth: 2,
                        tension: 0.35,
                        pointRadius: 3,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            ticks: {
                                color: '#fff',
                                callback: (v) => 'Rp ' + Number(v).toLocaleString('id-ID')
                            },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        },
                        x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.05)' } }
                    }
                }
            });
        }
    </script>
@endsection
