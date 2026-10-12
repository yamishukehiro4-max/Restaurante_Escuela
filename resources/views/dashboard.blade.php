@extends('layouts.app')

@section('title', 'Dashboard — Restaurante Escuela')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Panel de control</span>
        <h1 class="text-4xl md:text-5xl font-black mt-3 mb-2">Dashboard</h1>
        <p class="text-slate-500 dark:text-slate-400">Estadísticas en tiempo real del Restaurante Escuela</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="reveal group relative overflow-hidden p-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-3xl text-white shadow-xl shadow-orange-500/30 hover:shadow-orange-500/50 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-orange-100 text-sm font-medium">Ingresos totales</p>
                    <span class="text-2xl">💵</span>
                </div>
                <p class="text-3xl font-black">${{ number_format($totalSales, 2) }}</p>
            </div>
        </div>
        <div class="reveal p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Ventas</p>
                <span class="text-2xl">🛒</span>
            </div>
            <p class="text-3xl font-black">{{ $salesCount }}</p>
        </div>
        <div class="reveal p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Ticket promedio</p>
                <span class="text-2xl">📊</span>
            </div>
            <p class="text-3xl font-black">${{ number_format($averageSale, 2) }}</p>
        </div>
        <div class="reveal p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Alertas stock</p>
                <span class="text-2xl">⚠️</span>
            </div>
            <p class="text-3xl font-black {{ $lowStock->count() > 0 ? 'text-red-500' : '' }}">{{ $lowStock->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <div class="reveal bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <h3 class="font-black">🏆 Platillos más vendidos</h3>
                <span class="text-xs px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-full font-medium">Top 5</span>
            </div>
            <div class="p-6">
                @forelse($topDishes as $i => $dish)
                    <div class="flex items-center justify-between py-3 border-b border-slate-100 dark:border-slate-800 last:border-0">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-red-500 text-white flex items-center justify-center text-sm font-bold">{{ $i + 1 }}</span>
                            <div>
                                <p class="font-semibold">{{ $dish->name }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $dish->category->name ?? 'Sin categoría' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-orange-500">{{ $dish->sale_details_sum_quantity ?? 0 }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">${{ number_format($dish->price, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm text-center py-8">Sin datos de ventas aún.</p>
                @endforelse
            </div>
        </div>

        <div class="reveal bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <h3 class="font-black">⚠️ Stock bajo</h3>
                <span class="text-xs px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full font-medium">&lt; 10 unidades</span>
            </div>
            <div class="p-6">
                @forelse($lowStock as $material)
                    <div class="flex items-center justify-between py-3 border-b border-slate-100 dark:border-slate-800 last:border-0">
                        <div>
                            <p class="font-semibold">{{ $material->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">{{ $material->code }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-red-500">{{ $material->stock_current }} {{ $material->unit_measure }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $material->is_perishable ? '🔴 Perecedero' : '🟢 No perecedero' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-green-600 dark:text-green-400 text-sm text-center py-8">✅ Todo el inventario tiene stock suficiente.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="reveal bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
            <h3 class="font-black">💰 Ventas recientes</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-3 text-left font-bold">#</th>
                        <th class="px-6 py-3 text-left font-bold">Operador</th>
                        <th class="px-6 py-3 text-left font-bold">Fecha</th>
                        <th class="px-6 py-3 text-left font-bold">Método</th>
                        <th class="px-6 py-3 text-right font-bold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSales as $sale)
                        <tr class="border-b border-slate-100 dark:border-slate-800 last:border-0 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                            <td class="px-6 py-4 text-sm font-mono font-medium">#{{ $sale->id }}</td>
                            <td class="px-6 py-4 text-sm">{{ $sale->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-medium">{{ $sale->payment_method }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-right font-bold">${{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Sin ventas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection