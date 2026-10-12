@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Panel de control</span>
        <h1 class="text-4xl md:text-5xl font-black mt-3 mb-2">Dashboard</h1>
        <p class="text-slate-500 dark:text-slate-400">Estadísticas en tiempo real</p>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="p-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-3xl text-white shadow-xl">
            <p class="text-orange-100 text-sm">Ingresos totales</p>
            <p class="text-3xl font-black mt-2">${{ number_format($totalSales, 2) }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl">
            <p class="text-slate-500 text-sm">Ventas</p>
            <p class="text-3xl font-black mt-2">{{ $salesCount }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl">
            <p class="text-slate-500 text-sm">Ticket promedio</p>
            <p class="text-3xl font-black mt-2">${{ number_format($averageSale, 2) }}</p>
        </div>
        <div class="p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl">
            <p class="text-slate-500 text-sm">Alertas stock</p>
            <p class="text-3xl font-black mt-2 {{ $lowStock->count() > 0 ? 'text-red-500' : '' }}">{{ $lowStock->count() }}</p>
        </div>
    </div>

    <!-- GRÁFICOS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
            <h3 class="font-black mb-4">📈 Ventas últimos 7 días</h3>
            <div class="w-full" style="height: 250px; position: relative;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
            <h3 class="font-black mb-4">🥧 Platillos por categoría</h3>
            <div class="w-full" style="height: 250px; position: relative;">
                <canvas id="dishesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- TOP + STOCK -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="font-black">🏆 Top platillos</h3>
            </div>
            <div class="p-6">
                @forelse($topDishes as $i => $dish)
                    <div class="flex items-center justify-between py-3 border-b border-slate-100 dark:border-slate-800 last:border-0">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-orange-500 to-red-500 text-white flex items-center justify-center text-xs font-bold">{{ $i+1 }}</span>
                            <p class="font-semibold text-sm">{{ $dish->name }}</p>
                        </div>
                        <p class="font-bold text-orange-500 text-sm">{{ $dish->sale_details_sum_quantity ?? 0 }} vendidos</p>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">Sin datos.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="font-black">⚠️ Stock bajo</h3>
            </div>
            <div class="p-6">
                @forelse($lowStock as $m)
                    <div class="flex items-center justify-between py-3 border-b border-slate-100 dark:border-slate-800 last:border-0">
                        <div>
                            <p class="font-semibold text-sm">{{ $m->name }}</p>
                            <p class="text-xs text-slate-500 font-mono">{{ $m->code }}</p>
                        </div>
                        <p class="font-bold text-red-500 text-sm">{{ $m->stock_current }} {{ $m->unit_measure }}</p>
                    </div>
                @empty
                    <p class="text-green-500 text-sm">✅ Stock OK</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- VENTAS RECIENTES -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
            <h3 class="font-black">💰 Ventas recientes</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left">#</th>
                        <th class="px-4 md:px-6 py-3 text-left">Operador</th>
                        <th class="px-4 md:px-6 py-3 text-left hidden md:table-cell">Fecha</th>
                        <th class="px-4 md:px-6 py-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSales as $s)
                        <tr class="border-t border-slate-100 dark:border-slate-800">
                            <td class="px-4 md:px-6 py-3 text-sm font-mono">#{{ $s->id }}</td>
                            <td class="px-4 md:px-6 py-3 text-sm">{{ $s->user->name ?? 'N/A' }}</td>
                            <td class="px-4 md:px-6 py-3 text-sm text-slate-500 hidden md:table-cell">{{ \Carbon\Carbon::parse($s->sale_date)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 md:px-6 py-3 text-sm text-right font-bold">${{ number_format($s->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-slate-500">Sin ventas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
fetch('/api/chart-data')
    .then(r => r.json())
    .then(data => {
        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: data.sales_by_day.map(d => d.date),
                datasets: [{
                    label: 'Ventas ($)',
                    data: data.sales_by_day.map(d => d.total),
                    borderColor: '#F97316',
                    backgroundColor: 'rgba(249,115,22,0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        const colors = ['#F97316', '#EF4444', '#8B5CF6', '#06B6D4', '#22C55E', '#EAB308'];
        new Chart(document.getElementById('dishesChart'), {
            type: 'doughnut',
            data: {
                labels: data.dishes_by_category.map(d => d.name),
                datasets: [{
                    data: data.dishes_by_category.map(d => d.total),
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    });
</script>
@endsection