@extends('layouts.app')

@section('title', 'Restaurante Escuela — Sistema de Gestión')

@section('content')

<section class="relative overflow-hidden min-h-[90vh] flex items-center">
    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50 via-white to-red-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-orange-300/30 dark:bg-orange-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-red-300/30 dark:bg-red-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20 w-full">
        <div class="text-center max-w-4xl mx-auto">

            <div class="animate-fade-in-down inline-flex items-center gap-2 px-4 py-1.5 bg-white/60 dark:bg-slate-800/60 glass border border-orange-200 dark:border-slate-700 rounded-full text-sm font-medium mb-8 shadow-sm">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-slate-700 dark:text-slate-300">Sistema completo para gestión educativa</span>
            </div>

            <h1 class="animate-fade-in-up text-5xl md:text-7xl font-black mb-6 leading-tight">
                <span class="bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 bg-clip-text text-transparent">Gestión integral</span>
                <br>
                <span class="text-slate-900 dark:text-white">del Restaurante Escuela</span>
            </h1>

            <p class="animate-fade-in-up text-lg md:text-xl text-slate-600 dark:text-slate-400 mb-10 max-w-2xl mx-auto" style="animation-delay: 0.15s;">
                API REST construida con <strong class="text-slate-900 dark:text-white">Laravel 12</strong>, MySQL y autenticación Sanctum. Cubre ventas, inventario, compras, kardex, autoconsumo y eventos externos.
            </p>

            <div class="animate-fade-in-up flex flex-col sm:flex-row items-center justify-center gap-4" style="animation-delay: 0.3s;">
                <a href="/docs" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-2xl font-semibold shadow-xl shadow-orange-500/30 transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center gap-2">
                    <span>📚</span> Ver documentación
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
                <a href="/dashboard" class="px-8 py-4 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 rounded-2xl font-semibold text-slate-900 dark:text-white transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center gap-2 shadow-sm">
                    <span>📊</span> Ir al dashboard
                </a>
            </div>

            <div class="animate-fade-in-up grid grid-cols-2 md:grid-cols-4 gap-4 mt-16" style="animation-delay: 0.45s;">
                <div class="p-5 bg-white/60 dark:bg-slate-800/40 glass border border-slate-200 dark:border-slate-700/50 rounded-2xl">
                    <p class="text-3xl font-black bg-gradient-to-br from-orange-500 to-red-500 bg-clip-text text-transparent">{{ $stats['roles'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Roles</p>
                </div>
                <div class="p-5 bg-white/60 dark:bg-slate-800/40 glass border border-slate-200 dark:border-slate-700/50 rounded-2xl">
                    <p class="text-3xl font-black bg-gradient-to-br from-orange-500 to-red-500 bg-clip-text text-transparent">{{ $stats['users'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Usuarios</p>
                </div>
                <div class="p-5 bg-white/60 dark:bg-slate-800/40 glass border border-slate-200 dark:border-slate-700/50 rounded-2xl">
                    <p class="text-3xl font-black bg-gradient-to-br from-orange-500 to-red-500 bg-clip-text text-transparent">{{ $stats['dishes'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Platillos</p>
                </div>
                <div class="p-5 bg-white/60 dark:bg-slate-800/40 glass border border-slate-200 dark:border-slate-700/50 rounded-2xl">
                    <p class="text-3xl font-black bg-gradient-to-br from-orange-500 to-red-500 bg-clip-text text-transparent">{{ $stats['raw_materials'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">Insumos</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-14 reveal">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Módulos del sistema</span>
        <h2 class="text-4xl md:text-5xl font-black mt-3 mb-4">Todo lo que necesitás</h2>
        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">22 recursos REST completamente funcionales, listos para producción.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $modules = [
                ['🍔', 'Ventas y POS', 'Registro de ventas con cálculo automático de totales y detalle de platillos.', 'from-orange-500 to-red-500'],
                ['📦', 'Inventario y Kardex', 'Control de materia prima con entradas, salidas, mermas y autoconsumo.', 'from-emerald-500 to-teal-500'],
                ['🛒', 'Compras', 'Solicitudes, órdenes, facturas y actas de recepción con verificación.', 'from-purple-500 to-indigo-500'],
                ['💰', 'Caja y Cierres', 'Cierre diario con cálculo de faltantes y autoconsumo automático.', 'from-amber-500 to-orange-500'],
                ['👨‍🍳', 'Recetas', 'Vinculación de platillos con insumos para cálculo de costos.', 'from-pink-500 to-rose-500'],
                ['🎉', 'Eventos Externos', 'Banquetes y showers con aprobación del Consejo Directivo Escolar.', 'from-cyan-500 to-blue-500'],
            ];
        @endphp
        @foreach($modules as $i => $m)
            <div class="reveal group relative p-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500" style="transition-delay: {{ $i * 0.05 }}s">
                <div class="absolute inset-0 bg-gradient-to-br {{ $m[3] }} opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                <div class="relative">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $m[3] }} flex items-center justify-center text-2xl mb-5 shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        {{ $m[0] }}
                    </div>
                    <h3 class="text-xl font-bold mb-2">{{ $m[1] }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">{{ $m[2] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="reveal relative overflow-hidden rounded-3xl bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 p-12 md:p-20 text-center text-white">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        <div class="relative">
            <h2 class="text-4xl md:text-5xl font-black mb-4">¿Listo para probarlo?</h2>
            <p class="text-lg md:text-xl opacity-90 mb-8 max-w-2xl mx-auto">Todo el sistema está documentado y listo para testear con Postman o desde el dashboard.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/docs" class="px-8 py-4 bg-white text-orange-600 rounded-2xl font-bold shadow-xl hover:scale-105 active:scale-95 transition">
                    📚 Explorar documentación
                </a>
                <a href="/playground" class="px-8 py-4 bg-white/20 border border-white/30 hover:bg-white/30 rounded-2xl font-bold transition">
                    🔗 Probar API
                </a>
            </div>
        </div>
    </div>
</section>

@endsection