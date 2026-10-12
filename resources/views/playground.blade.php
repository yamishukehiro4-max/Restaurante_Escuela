@extends('layouts.app')

@section('title', 'API Playground — Restaurante Escuela')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-12">

    <!-- Header -->
    <div class="text-center mb-10">
        <span class="text-sm font-semibold text-orange-500 uppercase tracking-widest">Explorador interactivo</span>
        <h1 class="text-4xl md:text-5xl font-black mt-3 mb-4">API Playground</h1>
        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">Autenticate, seleccioná un endpoint y probá la API en vivo desde el navegador.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- PANEL IZQUIERDO: LOGIN -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-orange-500 to-red-500">
                    <h3 class="font-black text-white">🔐 Autenticación</h3>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input id="login-email" type="email" value="lidia@restaurante.edu.sv"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm mb-4 focus:outline-none focus:ring-2 focus:ring-orange-500">

                    <label class="block text-sm font-medium mb-2">Password</label>
                    <input id="login-password" type="text" value="123456"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm mb-4 focus:outline-none focus:ring-2 focus:ring-orange-500">

                    <button id="login-btn"
                        class="w-full px-4 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl font-semibold shadow-lg shadow-orange-500/30 transition hover:scale-[1.02] active:scale-95">
                        🔑 Iniciar sesión
                    </button>

                    <div id="login-status" class="mt-4 text-sm"></div>

                    <div id="token-info" class="mt-4 p-3 bg-slate-50 dark:bg-slate-800 rounded-xl hidden">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Token activo:</p>
                        <p id="token-value" class="text-xs font-mono break-all text-green-600 dark:text-green-400"></p>
                    </div>
                </div>
            </div>

            <!-- Info usuarios -->
            <div class="bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-900/50 rounded-3xl p-6">
                <p class="text-sm font-bold text-blue-900 dark:text-blue-300 mb-3">👥 Usuarios de prueba</p>
                <ul class="space-y-2 text-xs text-blue-700 dark:text-blue-400 font-mono">
                    <li>admin@restaurante.edu.sv</li>
                    <li>chef@restaurante.edu.sv</li>
                    <li>lidia@restaurante.edu.sv</li>
                    <li>caja@restaurante.edu.sv</li>
                </ul>
                <p class="text-xs text-blue-700 dark:text-blue-400 mt-3">Contraseña: <code class="bg-white/50 dark:bg-slate-800 px-1 rounded">123456</code></p>
            </div>
        </div>

        <!-- PANEL DERECHO: REQUEST/RESPONSE -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-indigo-600 to-indigo-500">
                    <h3 class="font-black text-white">🚀 Ejecutar petición</h3>
                </div>
                <div class="p-6">

                    <!-- Endpoints predefinidos -->
                    <label class="block text-sm font-medium mb-2">Endpoint</label>
                    <select id="endpoint-select"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm mb-4 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">— Seleccioná un endpoint —</option>
                        <optgroup label="Núcleo">
                            <option value="GET /api/v1/roles">GET /api/v1/roles</option>
                            <option value="GET /api/v1/users">GET /api/v1/users</option>
                            <option value="GET /api/v1/dishes">GET /api/v1/dishes</option>
                            <option value="GET /api/v1/dish-categories">GET /api/v1/dish-categories</option>
                            <option value="GET /api/v1/raw-materials">GET /api/v1/raw-materials</option>
                            <option value="GET /api/v1/suppliers">GET /api/v1/suppliers</option>
                        </optgroup>
                        <optgroup label="Ventas y Caja">
                            <option value="GET /api/v1/sales">GET /api/v1/sales</option>
                            <option value="GET /api/v1/cash-register-closings">GET /api/v1/cash-register-closings</option>
                        </optgroup>
                        <optgroup label="Inventario">
                            <option value="GET /api/v1/raw-material-movements">GET /api/v1/raw-material-movements</option>
                            <option value="GET /api/v1/recipes">GET /api/v1/recipes</option>
                        </optgroup>
                        <optgroup label="Compras">
                            <option value="GET /api/v1/purchase-requests">GET /api/v1/purchase-requests</option>
                            <option value="GET /api/v1/purchase-orders">GET /api/v1/purchase-orders</option>
                            <option value="GET /api/v1/purchase-invoices">GET /api/v1/purchase-invoices</option>
                        </optgroup>
                        <optgroup label="Otros">
                            <option value="GET /api/v1/customers">GET /api/v1/customers</option>
                            <option value="GET /api/v1/orders">GET /api/v1/orders</option>
                            <option value="GET /api/v1/utensils">GET /api/v1/utensils</option>
                            <option value="GET /api/v1/external-events">GET /api/v1/external-events</option>
                            <option value="GET /api/v1/student-practices">GET /api/v1/student-practices</option>
                        </optgroup>
                        <optgroup label="Usuario actual">
                            <option value="GET /api/v1/me">GET /api/v1/me</option>
                        </optgroup>
                    </select>

                    <div class="flex gap-2">
                        <button id="send-btn"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white rounded-xl font-semibold shadow-lg shadow-indigo-500/30 transition hover:scale-[1.02] active:scale-95 disabled:opacity-50">
                            ⚡ Enviar petición
                        </button>
                        <button id="clear-btn"
                            class="px-4 py-3 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-xl font-semibold transition">
                            🗑️ Limpiar
                        </button>
                    </div>

                </div>
            </div>

            <!-- Response -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-black">📥 Respuesta</h3>
                    <span id="status-badge" class="hidden text-xs px-3 py-1 rounded-full font-bold"></span>
                </div>
                <div class="p-6">
                    <pre id="response-box" class="bg-slate-900 dark:bg-black text-green-300 p-4 rounded-xl text-xs overflow-x-auto font-mono min-h-[300px] max-h-[600px] overflow-y-auto whitespace-pre-wrap break-all">// Hacé clic en "Enviar petición" para ver la respuesta aquí...</pre>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const tokenKey = 'api_token_playground';

    // Cargar token guardado
    const savedToken = localStorage.getItem(tokenKey);
    if (savedToken) {
        document.getElementById('token-info').classList.remove('hidden');
        document.getElementById('token-value').textContent = savedToken;
    }

    // LOGIN
    document.getElementById('login-btn').addEventListener('click', async () => {
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;
        const status = document.getElementById('login-status');

        status.innerHTML = '<span class="text-slate-500">⏳ Autenticando...</span>';

        try {
            const response = await fetch('/api/v1/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (response.ok && data.token) {
                localStorage.setItem(tokenKey, data.token);
                status.innerHTML = '<span class="text-green-600 dark:text-green-400">✅ Sesión iniciada como ' + data.user.name + '</span>';
                document.getElementById('token-info').classList.remove('hidden');
                document.getElementById('token-value').textContent = data.token;
            } else {
                status.innerHTML = '<span class="text-red-500">❌ ' + (data.message || 'Error de login') + '</span>';
            }
        } catch (err) {
            status.innerHTML = '<span class="text-red-500">❌ ' + err.message + '</span>';
        }
    });

    // SEND REQUEST
    document.getElementById('send-btn').addEventListener('click', async () => {
        const selected = document.getElementById('endpoint-select').value;
        const responseBox = document.getElementById('response-box');
        const statusBadge = document.getElementById('status-badge');

        if (!selected) {
            responseBox.textContent = '// ⚠️ Primero seleccioná un endpoint arriba.';
            return;
        }

        const token = localStorage.getItem(tokenKey);
        if (!token) {
            responseBox.textContent = '// ⚠️ Primero iniciá sesión arriba a la izquierda.';
            statusBadge.classList.add('hidden');
            return;
        }

        const [method, url] = selected.split(' ');
        responseBox.textContent = '// ⏳ Cargando...';

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            });

            const text = await response.text();
            let pretty = text;
            try {
                pretty = JSON.stringify(JSON.parse(text), null, 2);
            } catch (e) {}

            responseBox.textContent = pretty;

            // Badge de status
            statusBadge.classList.remove('hidden');
            if (response.ok) {
                statusBadge.className = 'text-xs px-3 py-1 rounded-full font-bold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400';
                statusBadge.textContent = '✅ ' + response.status + ' ' + response.statusText;
            } else {
                statusBadge.className = 'text-xs px-3 py-1 rounded-full font-bold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400';
                statusBadge.textContent = '❌ ' + response.status + ' ' + response.statusText;
            }
        } catch (err) {
            responseBox.textContent = '// ❌ Error: ' + err.message;
            statusBadge.classList.add('hidden');
        }
    });

    // CLEAR
    document.getElementById('clear-btn').addEventListener('click', () => {
        document.getElementById('response-box').textContent = '// Hacé clic en "Enviar petición" para ver la respuesta aquí...';
        document.getElementById('status-badge').classList.add('hidden');
        document.getElementById('endpoint-select').value = '';
    });

    // Logout implícito: doble clic en token lo borra
    document.getElementById('token-info').addEventListener('dblclick', () => {
        localStorage.removeItem(tokenKey);
        document.getElementById('token-info').classList.add('hidden');
        document.getElementById('login-status').innerHTML = '<span class="text-slate-500">🔓 Sesión cerrada (doble clic en token)</span>';
    });
</script>
@endpush