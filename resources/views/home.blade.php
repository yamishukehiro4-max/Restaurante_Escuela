@extends('layouts.app')

@section('title', 'Restaurante Escuela — Sistema de Gestión')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50 via-white to-red-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-orange-300/30 dark:bg-orange-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-red-300/30 dark:bg-red-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/60 dark:bg-slate-800/60 glass border border-orange-200 dark:border-slate-700 rounded-full text-sm font-medium mb-6 shadow-sm">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-slate-700 dark:text-slate-300">Sistema completo para gestión educativa</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-black mb-4 leading-tight">
                <span class="bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 bg-clip-text text-transparent">Gestión integral</span>
                <br>
                <span class="text-slate-900 dark:text-white">del Restaurante Escuela</span>
            </h1>

            <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
                API REST construida con <strong class="text-slate-900 dark:text-white">Laravel 12</strong>, MySQL y Sanctum. Todo el sistema en un solo lugar.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/dashboard" class="group px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg shadow-orange-500/30 hover:scale-105 transition-all inline-flex items-center gap-2">
                    📊 Ir al Dashboard
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
                <a href="/playground" class="px-6 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl font-semibold hover:scale-105 transition-all">
                    🎮 API Playground
                </a>
                <a href="/docs" class="px-6 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl font-semibold hover:scale-105 transition-all">
                    📚 Documentación
                </a>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
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

<!-- ACCESO RÁPIDO A MÓDULOS -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Acceso rápido</span>
        <h2 class="text-3xl md:text-4xl font-black mt-2 mb-3">Todos los módulos del sistema</h2>
        <p class="text-slate-500 dark:text-slate-400">Hacé clic en cualquier tarjeta para acceder</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        <!-- Dashboard -->
        <a href="/dashboard" class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-red-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
            <div class="relative flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">📊</div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">Dashboard</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Estadísticas, gráficos de ventas y KPIs en tiempo real.</p>
                </div>
            </div>
        </a>

        <!-- Platillos -->
        <a href="/admin/dishes" class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-orange-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
            <div class="relative flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">🍔</div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">Platillos</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">CRUD del menú: crear, editar y eliminar platillos.</p>
                </div>
            </div>
        </a>

        <!-- Usuarios -->
        <a href="/admin/users" class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
            <div class="relative flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">👥</div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">Usuarios</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Gestión de usuarios con roles y NIE estudiantil.</p>
                </div>
            </div>
        </a>

        <!-- Proveedores -->
        <a href="/admin/suppliers" class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
            <div class="relative flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">🛒</div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">Proveedores</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Directorio de proveedores activos e inactivos.</p>
                </div>
            </div>
        </a>

        <!-- Materia Prima -->
        <a href="/admin/raw-materials" class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
            <div class="relative flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">📦</div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">Materia Prima</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Inventario de insumos con control de stock.</p>
                </div>
            </div>
        </a>

        <!-- Playground -->
        <a href="/playground" class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 to-blue-500 opacity-0 group-hover:opacity-5 transition-opacity"></div>
            <div class="relative flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">🎮</div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">API Playground</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Probar los 111 endpoints desde el navegador.</p>
                </div>
            </div>
        </a>
    </div>
</section>

<!-- MÓDULOS DEL SISTEMA -->
<section class="max-w-7xl mx-auto px-6 py-16 bg-slate-50 dark:bg-slate-900/50 rounded-3xl">
    <div class="text-center mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Módulos funcionales</span>
        <h2 class="text-3xl md:text-4xl font-black mt-2 mb-3">Todo lo que hace el sistema</h2>
        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">22 recursos REST completamente funcionales, listos para producción.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
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
        @foreach($modules as $m)
            <div class="group relative p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-br {{ $m[3] }} opacity-0 group-hover:opacity-5 transition-opacity"></div>
                <div class="relative">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $m[3] }} flex items-center justify-center text-xl mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        {{ $m[0] }}
                    </div>
                    <h3 class="text-lg font-bold mb-2">{{ $m[1] }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">{{ $m[2] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- REGLAS DE NEGOCIO -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Reglas de negocio</span>
        <h2 class="text-3xl md:text-4xl font-black mt-2 mb-3">Lógica específica del restaurante</h2>
        <p class="text-slate-500 dark:text-slate-400">Aplicadas directamente en el código</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="p-6 bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-950/20 dark:to-red-950/20 border border-orange-200 dark:border-orange-900/50 rounded-3xl">
            <div class="text-3xl mb-3">🍽️</div>
            <h3 class="font-bold text-lg mb-2">Autoconsumo</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Cuando falta un producto en el arqueo, se registra como autoconsumo sin perjudicar al estudiante.</p>
        </div>
        <div class="p-6 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/20 dark:to-teal-950/20 border border-emerald-200 dark:border-emerald-900/50 rounded-3xl">
            <div class="text-3xl mb-3">📦</div>
            <h3 class="font-bold text-lg mb-2">Kardex automático</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Cada movimiento actualiza el stock en tiempo real. Imposible vender más de lo disponible.</p>
        </div>
        <div class="p-6 bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-950/20 dark:to-blue-950/20 border border-cyan-200 dark:border-cyan-900/50 rounded-3xl">
            <div class="text-3xl mb-3">☔</div>
            <h3 class="font-bold text-lg mb-2">Mermas por clima</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Registro específico de pérdidas por lluvia o daños.</p>
        </div>
        <div class="p-6 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-950/20 dark:to-pink-950/20 border border-purple-200 dark:border-purple-900/50 rounded-3xl">
            <div class="text-3xl mb-3">⛽</div>
            <h3 class="font-bold text-lg mb-2">Prorrateo de gas</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">El costo de un tanque se divide entre los días de uso (aprox. 2 semanas).</p>
        </div>
        <div class="p-6 bg-gradient-to-br from-amber-50 to-yellow-50 dark:from-amber-950/20 dark:to-yellow-950/20 border border-amber-200 dark:border-amber-900/50 rounded-3xl">
            <div class="text-3xl mb-3">📋</div>
            <h3 class="font-bold text-lg mb-2">Aprobación del CDE</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Solo el Consejo Directivo cambia precios oficiales y aprueba eventos externos.</p>
        </div>
        <div class="p-6 bg-gradient-to-br from-pink-50 to-rose-50 dark:from-pink-950/20 dark:to-rose-950/20 border border-pink-200 dark:border-pink-900/50 rounded-3xl">
            <div class="text-3xl mb-3">🎉</div>
            <h3 class="font-bold text-lg mb-2">Eventos externos</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Flujo separado para banquetes y showers con aprobación especial.</p>
        </div>
    </div>
</section>

<!-- STACK TECNOLÓGICO -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Tecnologías</span>
        <h2 class="text-3xl md:text-4xl font-black mt-2 mb-3">Stack completo</h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">🐘</div>
            <p class="font-bold">Laravel 12</p>
            <p class="text-xs text-slate-500">Framework PHP</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">🐬</div>
            <p class="font-bold">MySQL</p>
            <p class="text-xs text-slate-500">Base de datos</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">🔐</div>
            <p class="font-bold">Sanctum</p>
            <p class="text-xs text-slate-500">Autenticación</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">🎨</div>
            <p class="font-bold">Tailwind</p>
            <p class="text-xs text-slate-500">Estilos</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">📊</div>
            <p class="font-bold">Chart.js</p>
            <p class="text-xs text-slate-500">Gráficos</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">🐙</div>
            <p class="font-bold">Git + GitHub</p>
            <p class="text-xs text-slate-500">Versionamiento</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">💻</div>
            <p class="font-bold">VS Code</p>
            <p class="text-xs text-slate-500">Editor</p>
        </div>
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-center hover:scale-105 transition-transform">
            <div class="text-4xl mb-2">🖥️</div>
            <p class="font-bold">XAMPP</p>
            <p class="text-xs text-slate-500">Entorno</p>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 p-10 md:p-16 text-center text-white">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        <div class="relative">
            <h2 class="text-3xl md:text-5xl font-black mb-4">¿Listo para probarlo?</h2>
            <p class="text-lg md:text-xl opacity-90 mb-8 max-w-2xl mx-auto">Todo el sistema está documentado y listo para testear con el Playground o cURL.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/playground" class="px-8 py-4 bg-white text-orange-600 rounded-2xl font-bold shadow-xl hover:scale-105 transition">
                    🎮 Probar API
                </a>
                <a href="/docs" class="px-8 py-4 bg-white/20 border border-white/30 hover:bg-white/30 rounded-2xl font-bold transition">
                    📚 Ver documentación
                </a>
            </div>
        </div>
    </div>
</section>

@endsection