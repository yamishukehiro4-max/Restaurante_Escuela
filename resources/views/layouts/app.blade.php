<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Restaurante Escuela')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: {
                fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], mono: ['JetBrains Mono', 'monospace'] },
                animation: { 'fade-in': 'fadeIn 0.6s ease-out', 'fade-in-up': 'fadeInUp 0.7s ease-out', 'float': 'float 6s ease-in-out infinite' },
                keyframes: {
                    fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                    fadeInUp: { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                    float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-20px)' } },
                }
            }}
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="icon" href="/logo.svg">
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: rgba(156, 163, 175, 0.4); border-radius: 4px; }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .glass { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
    </style>
</head>
<body class="font-sans bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-500 min-h-screen">

    <header class="sticky top-0 z-50 glass bg-white/90 dark:bg-slate-950/90 border-b border-slate-200 dark:border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16 gap-4">

                <a href="/" class="flex items-center gap-3 shrink-0">
                    <img src="/logo.svg" alt="Logo" class="w-10 h-10 rounded-xl shadow-lg shadow-orange-500/20 hover:scale-105 transition-transform">
                    <div class="hidden sm:block">
                        <h1 class="font-extrabold text-base leading-tight">Restaurante Escuela</h1>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 tracking-wider uppercase">API REST · Laravel 12</p>
                    </div>
                </a>

                <nav class="hidden xl:flex items-center gap-1">
                    <a href="/" class="px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition">Inicio</a>
                    <a href="/dashboard" class="px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition">Dashboard</a>

                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition">
                            Catálogos
                            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-56 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                            <a href="/admin/dishes" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-t-xl">🍔 Platillos</a>
                            <a href="/admin/users" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50">👥 Usuarios</a>
                            <a href="/admin/suppliers" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50">🛒 Proveedores</a>
                            <a href="/admin/raw-materials" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50">📦 Materia Prima</a>
                            <a href="/admin/recipes" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-b-xl">👨‍🍳 Recetas</a>
                        </div>
                    </div>

                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition">
                            Operaciones
                            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-56 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                            <a href="/admin/sales" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-t-xl">💰 Ventas</a>
                            <a href="/admin/movements" class="block px-4 py-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-b-xl">📊 Kardex</a>
                        </div>
                    </div>

                    <a href="/playground" class="px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition">Playground</a>
                    <a href="/docs" class="px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition">Docs</a>
                </nav>

                <div class="flex items-center gap-2 shrink-0">

                    <button id="theme-toggle" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center transition" aria-label="Cambiar tema">
                        <svg class="w-5 h-5 text-amber-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <svg class="w-5 h-5 text-slate-700 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                    </button>

                    <button id="mobile-menu-btn" class="xl:hidden w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    @auth
                        <form method="POST" action="/logout" class="hidden sm:inline-block">
                            @csrf
                            <button type="submit" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-xl text-xs font-semibold transition">
                                👤 {{ \Illuminate\Support\Str::limit(Auth::user()->name, 12) }} · Salir
                            </button>
                        </form>
                    @else
                        <a href="/login" class="hidden sm:inline-flex px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl text-xs font-semibold shadow-lg">Iniciar sesión →</a>
                    @endauth
                </div>
            </div>

            <div id="mobile-menu" class="xl:hidden hidden border-t border-slate-200 dark:border-slate-800 py-4">
                <nav class="grid grid-cols-2 gap-2">
                    <a href="/" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">🏠 Inicio</a>
                    <a href="/dashboard" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">📊 Dashboard</a>
                    <a href="/admin/dishes" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">🍔 Platillos</a>
                    <a href="/admin/users" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">👥 Usuarios</a>
                    <a href="/admin/suppliers" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">🛒 Proveedores</a>
                    <a href="/admin/raw-materials" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">📦 Materia Prima</a>
                    <a href="/admin/recipes" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">👨‍🍳 Recetas</a>
                    <a href="/admin/sales" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">💰 Ventas</a>
                    <a href="/admin/movements" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">📊 Kardex</a>
                    <a href="/playground" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">🎮 Playground</a>
                    <a href="/docs" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">📚 Docs</a>
                    <a href="/qr" class="px-3 py-2.5 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">📱 QR</a>

                    @auth
                        <form method="POST" action="/logout" class="col-span-2 mt-2">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm font-semibold rounded-lg">
                                👤 {{ Auth::user()->name }} · Cerrar sesión
                            </button>
                        </form>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 dark:border-slate-800/50 py-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500 dark:text-slate-400">
                <p>© {{ date('Y') }} Restaurante Escuela · Sistema de gestión</p>
                <p>Hecho con <span class="text-red-500">❤️</span> para la educación</p>
            </div>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>