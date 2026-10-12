@extends('layouts.app')

@section('title', 'Documentación API — Restaurante Escuela')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="text-center mb-12">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Documentación</span>
        <h1 class="text-4xl md:text-5xl font-black mt-3 mb-4">API REST Reference</h1>
        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">Todos los endpoints del sistema, listos para usar con Postman o cURL.</p>
    </div>

    <div class="grid grid-cols-12 gap-8">
        <aside class="col-span-12 lg:col-span-3">
            <div class="sticky top-24 space-y-3">
                <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl">
                    <p class="text-xs uppercase tracking-wider font-bold text-slate-400 mb-3">Módulos</p>
                    <nav class="space-y-1 text-sm">
                        <a href="#auth" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">🔐 Autenticación</a>
                        <a href="#core" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">⚙️ Núcleo</a>
                        <a href="#inventory" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">📦 Inventario</a>
                        <a href="#purchases" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">🛒 Compras</a>
                        <a href="#sales" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">💰 Ventas</a>
                        <a href="#customers" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">👥 Clientes</a>
                        <a href="#events" class="block px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-orange-50 dark:hover:bg-slate-800 hover:text-orange-500 transition">🎉 Eventos</a>
                    </nav>
                </div>

                <div class="p-4 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/30 border border-blue-200 dark:border-blue-900/50 rounded-2xl">
                    <p class="text-sm font-bold text-blue-900 dark:text-blue-300 mb-2">🔑 Autenticación</p>
                    <ol class="text-xs text-blue-700 dark:text-blue-400 space-y-1 list-decimal list-inside">
                        <li>POST <code class="px-1 bg-white/50 dark:bg-slate-800 rounded">/api/v1/login</code></li>
                        <li>Copiá el <code class="px-1 bg-white/50 dark:bg-slate-800 rounded">token</code></li>
                        <li>Enviá <code class="px-1 bg-white/50 dark:bg-slate-800 rounded">Bearer &lt;token&gt;</code></li>
                    </ol>
                </div>
            </div>
        </aside>

        <main class="col-span-12 lg:col-span-9 space-y-8">

            <section id="auth" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-800 to-slate-700 px-6 py-5">
                    <h2 class="text-white font-black text-xl">🔐 Autenticación</h2>
                    <p class="text-slate-300 text-sm">Endpoints públicos y protegidos</p>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md text-xs font-bold">POST</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/login</code>
                        <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded">🌐 Público</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md text-xs font-bold">POST</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/logout</code>
                        <span class="text-xs px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded">🔒 Auth</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-md text-xs font-bold">GET</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/me</code>
                        <span class="text-xs px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded">🔒 Auth</span>
                    </div>

                    <div class="mt-6">
                        <p class="text-sm font-semibold mb-2">Ejemplo de login:</p>
                        <pre class="bg-slate-900 dark:bg-black text-green-300 p-4 rounded-xl text-xs overflow-x-auto font-mono"><code>curl -X POST http://127.0.0.1:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"lidia@restaurante.edu.sv","password":"123456"}'</code></pre>
                    </div>
                </div>
            </section>

            <section id="core" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 px-6 py-5">
                    <h2 class="text-white font-black text-xl">⚙️ Núcleo del sistema</h2>
                    <p class="text-indigo-100 text-sm">Roles, usuarios, platillos y categorías</p>
                </div>
                <div class="p-6">
                    @foreach([
                        ['roles', 'Roles del sistema'],
                        ['users', 'Usuarios'],
                        ['dish-categories', 'Categorías de platillos'],
                        ['dishes', 'Platillos'],
                        ['raw-material-categories', 'Categorías de materia prima'],
                        ['raw-materials', 'Materia prima'],
                        ['suppliers', 'Proveedores'],
                    ] as $r)
                        <div class="border border-slate-200 dark:border-slate-700 rounded-xl p-4 mb-3 hover:shadow-lg transition">
                            <p class="font-semibold text-sm mb-3">{{ $r[1] }} <code class="text-xs text-slate-500 font-mono">/api/v1/{{ $r[0] }}</code></p>
                            <div class="grid grid-cols-5 gap-2">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded text-xs text-center font-mono font-bold">GET</span>
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded text-xs text-center font-mono font-bold">POST</span>
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded text-xs text-center font-mono font-bold">GET/{id}</span>
                                <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded text-xs text-center font-mono font-bold">PUT</span>
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded text-xs text-center font-mono font-bold">DELETE</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="inventory" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-5">
                    <h2 class="text-white font-black text-xl">📦 Inventario y Kardex</h2>
                    <p class="text-emerald-100 text-sm">Movimientos, mermas y autoconsumo</p>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 p-3 bg-emerald-50 dark:bg-emerald-950/30 rounded-xl border border-emerald-200 dark:border-emerald-900/50">
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-md text-xs font-bold font-mono">GET</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/raw-materials/{id}/kardex</code>
                        <span class="text-xs text-emerald-700 dark:text-emerald-400 font-medium">⭐ Kardex</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md text-xs font-bold font-mono">POST</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/raw-material-movements</code>
                        <span class="text-xs text-slate-500">Movimientos</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/recipes</code>
                        <span class="text-xs text-slate-500">Recetas</span>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm font-semibold mb-2">Tipos de movimiento:</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                            <span class="px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-xs text-center font-medium">✅ Entrada</span>
                            <span class="px-3 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg text-xs text-center font-medium">📤 Salida</span>
                            <span class="px-3 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-lg text-xs text-center font-medium">🌧️ Merma_Clima</span>
                            <span class="px-3 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded-lg text-xs text-center font-medium">🍽️ Autoconsumo</span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="purchases" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-500 px-6 py-5">
                    <h2 class="text-white font-black text-xl">🛒 Compras y Proveedores</h2>
                    <p class="text-purple-100 text-sm">Solicitudes, órdenes, actas y facturas</p>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/purchase-requests</code>
                        <span class="text-xs text-slate-500">Solicitudes</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/purchase-orders</code>
                        <span class="text-xs text-slate-500">Órdenes</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/goods-receipt-acts</code>
                        <span class="text-xs text-slate-500">Actas</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/purchase-invoices</code>
                        <span class="text-xs text-slate-500">Facturas</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-purple-50 dark:bg-purple-950/30 rounded-xl border border-purple-200 dark:border-purple-900/50">
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md text-xs font-bold font-mono">POST</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/purchase-invoices/{id}/pay</code>
                        <span class="text-xs text-purple-700 dark:text-purple-400">⭐ Pagar</span>
                    </div>
                </div>
            </section>

            <section id="sales" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-600 to-red-500 px-6 py-5">
                    <h2 class="text-white font-black text-xl">💰 Ventas y Caja</h2>
                    <p class="text-orange-100 text-sm">Ventas y cierre con autoconsumo automático</p>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/sales</code>
                        <span class="text-xs text-slate-500">Ventas con detalle</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-orange-50 dark:bg-orange-950/30 rounded-xl border border-orange-200 dark:border-orange-900/50">
                        <code class="text-sm flex-1 font-mono">/api/v1/cash-register-closings</code>
                        <span class="text-xs text-orange-700 dark:text-orange-400">⭐ Autoconsumo</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm font-semibold mb-2">Ejemplo de venta:</p>
                        <pre class="bg-slate-900 dark:bg-black text-green-300 p-4 rounded-xl text-xs overflow-x-auto font-mono"><code>POST /api/v1/sales
{
  "user_id": 1,
  "sale_date": "2026-10-12 12:30:00",
  "payment_method": "Efectivo",
  "items": [
    {"dish_id": 1, "quantity": 2},
    {"dish_id": 2, "quantity": 1}
  ]
}</code></pre>
                    </div>
                </div>
            </section>

            <section id="customers" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-pink-600 to-rose-500 px-6 py-5">
                    <h2 class="text-white font-black text-xl">👥 Clientes y Pedidos</h2>
                    <p class="text-pink-100 text-sm">Gestión de clientes y sus pedidos</p>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/customers</code>
                        <span class="text-xs text-slate-500">Clientes</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/orders</code>
                        <span class="text-xs text-slate-500">Pedidos</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/student-practices</code>
                        <span class="text-xs text-slate-500">Prácticas</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/utensils</code>
                        <span class="text-xs text-slate-500">Utensilios</span>
                    </div>
                </div>
            </section>

            <section id="events" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-600 to-blue-500 px-6 py-5">
                    <h2 class="text-white font-black text-xl">🎉 Eventos Externos</h2>
                    <p class="text-cyan-100 text-sm">Banquetes y showers aprobados por CDE</p>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-4 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <code class="text-sm flex-1 font-mono">/api/v1/external-events</code>
                        <span class="text-xs text-slate-500">CRUD eventos</span>
                    </div>
                    <div class="flex items-center gap-4 p-3 bg-cyan-50 dark:bg-cyan-950/30 rounded-xl border border-cyan-200 dark:border-cyan-900/50">
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md text-xs font-bold font-mono">POST</span>
                        <code class="text-sm flex-1 font-mono">/api/v1/external-events/{id}/approve</code>
                        <span class="text-xs text-cyan-700 dark:text-cyan-400">⭐ Aprobar</span>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>

@endsection