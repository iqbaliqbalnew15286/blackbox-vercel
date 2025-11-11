@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Laporan Penjualan</h2>
        <p class="text-gray-600 dark:text-gray-300">
            Ringkasan transaksi
            {{ $period === 'daily' ? 'harian' : ($period === 'weekly' ? 'mingguan' : 'bulanan') }} —
            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $titleRange }}</span>
        </p>
    </div>

    {{-- 🔍 Filter Form --}}
    <div
        class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 mb-6 transition-colors duration-300">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="period" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Periode</label>
                <select name="period" id="period"
                    class="mt-1 block w-full rounded-lg bg-gray-100 dark:bg-gray-900 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    <option value="daily" {{ ($period ?? '') === 'daily' ? 'selected' : '' }}>Harian</option>
                    <option value="weekly" {{ ($period ?? '') === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ ($period ?? '') === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mingguan dimulai Senin, Bulanan pakai bulan dari
                    tanggal dipilih.</p>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                <input type="date" name="date" id="date" value="{{ $date ?? '' }}"
                    class="mt-1 block w-full rounded-lg bg-gray-100 dark:bg-gray-900 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Untuk bulanan, pilih tanggal di bulan yang
                    diinginkan.</p>
            </div>

            <div>
                <label for="kasir_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter
                    Kasir</label>
                <select name="kasir_id" id="kasir_id"
                    class="mt-1 block w-full rounded-lg bg-gray-100 dark:bg-gray-900 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    <option value="">Semua Kasir</option>
                    @foreach (\App\Models\User::where('role', 'kasir')->get() as $kasir)
                        <option value="{{ $kasir->id }}" {{ ($kasirId ?? '') == $kasir->id ? 'selected' : '' }}>
                            {{ $kasir->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Filter laporan berdasarkan kasir tertentu.</p>
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-amber-500 text-black px-5 py-3 rounded-xl hover:bg-amber-600 focus:ring-2 focus:ring-amber-500 font-semibold transition">
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
                [
                    'title' => 'Total Penjualan',
                    'value' => number_format($totalSales ?? 0, 0, ',', '.'),
                    'color' => 'emerald',
                ],
                ['title' => 'Total Transaksi', 'value' => $totalTransactions ?? 0, 'color' => 'blue'],
                [
                    'title' => 'Total Pembayaran',
                    'value' => number_format($totalPayment ?? 0, 0, ',', '.'),
                    'color' => 'purple',
                ],
                [
                    'title' => 'Total Kembalian',
                    'value' => number_format($totalChange ?? 0, 0, ',', '.'),
                    'color' => 'orange',
                ],
                [
                    'title' => 'Rata-rata Penjualan/Hari',
                    'value' => number_format($avgSalesPerDay ?? 0, 0, ',', '.'),
                    'color' => 'cyan',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $card['title'] }}</h3>
                <p class="mt-1 text-3xl font-extrabold text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400">
                    Rp {{ $card['value'] }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- 📈 Grafik Penjualan --}}
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Grafik Total Penjualan ({{ $titleRange }})
        </h3>
        <canvas id="salesChart" height="110"></canvas>
    </div>

    {{-- 🏆 Top Produk Terjual --}}
    @if (!empty($topProducts) && count($topProducts) > 0)
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Produk Terjual</h3>
            <div class="space-y-3">
                @foreach ($topProducts as $index => $produk)
                    <div
                        class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $index + 1 }}</span>
                            <span class="text-gray-900 dark:text-white">{{ $produk['nama'] }}</span>
                        </div>
                        <span class="text-gray-600 dark:text-gray-300">{{ $produk['qty'] }} terjual</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- 🗓️ Rekap per Hari --}}
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6 transition-colors duration-300">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rekap per Hari</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-900">
                    <tr>
                        @foreach (['Hari', 'Transaksi', 'Total Penjualan', 'Total Pembayaran', 'Total Kembalian'] as $head)
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                {{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($perDay ?? [] as $d)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-3 text-sm text-gray-900 dark:text-white">{{ $d['date'] ?? '-' }}</td>
                            <td class="px-6 py-3 text-sm text-right text-gray-900 dark:text-white">{{ $d['count'] ?? 0 }}
                            </td>
                            <td class="px-6 py-3 text-sm text-right text-emerald-600 dark:text-emerald-400">Rp
                                {{ number_format($d['sum_sales'] ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-purple-600 dark:text-purple-400">Rp
                                {{ number_format($d['sum_payment'] ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-orange-600 dark:text-orange-400">Rp
                                {{ number_format($d['sum_change'] ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak
                                ada data pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 🧾 Detail Transaksi --}}
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6 transition-colors duration-300">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Transaksi ({{ $titleRange }})</h3>
            <div class="flex items-center gap-2">
                @foreach ([['route' => 'excel', 'color' => 'green', 'label' => 'Excel'], ['route' => 'pdf', 'color' => 'red', 'label' => 'PDF'], ['route' => 'print', 'color' => 'blue', 'label' => 'Print']] as $btn)
                    <a href="{{ route('admin.reports.export.' . $btn['route'], request()->query()) }}"
                        class="inline-flex items-center gap-2 bg-{{ $btn['color'] }}-600 text-white px-4 py-2 rounded-lg hover:bg-{{ $btn['color'] }}-700 text-sm font-medium transition">
                        {{ $btn['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-900">
                    <tr>
                        @foreach (['Kode', 'Kasir', 'Tanggal', 'Total', 'Bayar', 'Kembalian'] as $head)
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                {{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transaksis ?? [] as $t)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-3 text-sm font-medium text-blue-600 dark:text-blue-400">
                                <a href="{{ route('admin.kasir.struk', $t->id) }}"
                                    class="hover:underline">{{ $t->kode_transaksi }}</a>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $t->kasir->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($t->created_at)->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-right text-gray-900 dark:text-white">Rp
                                {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-gray-900 dark:text-white">Rp
                                {{ number_format($t->uang_dibayar ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-gray-900 dark:text-white">Rp
                                {{ number_format($t->kembalian ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak
                                ada transaksi untuk periode ini.</td>
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
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: (v) => 'Rp ' + Number(v).toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection
