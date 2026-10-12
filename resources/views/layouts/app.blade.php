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
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'fade-in-up': 'fadeInUp 0.7s ease-out',
                        'fade-in-down': 'fadeInDown 0.7s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'spin-slow': 'spin 20s linear infinite',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        fadeInUp: { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        fadeInDown: { '0%': { opacity: '0', transform: 'translateY(-30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-20px)' } },
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🍽️</text></svg>">

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
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(156, 163, 175, 0.4); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(156, 163, 175, 0.7); }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .glass { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
    </style>
</head>
<body class="font-sans bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-500 min-h-screen">

    <header class="sticky top-0 z-50 glass bg-white/80 dark:bg-slate-950/80 border-b border-slate-200 dark:border-slate-800/50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 via-red-500 to-pink-500 rounded-xl flex items-center justify-center font-bold text-lg shadow-lg shadow-orange-500/30 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                    🍽️
                </div>
                <div>
                    <h1 class="font-extrabold text-lg tracking-tight">Restaurante Escuela</h1>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 tracking-widest uppercase">API REST · Laravel 12</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-1">
                <a href="/" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 dark:hover:text-orange-400 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800/50">Inicio</a>
                <a href="/docs" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 dark:hover:text-orange-400 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800/50">Documentación</a>
                <a href="/dashboard" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 dark:hover:text-orange-400 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800/50">Dashboard</a>
                <a href="/admin/dishes" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 dark:hover:text-orange-400 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800/50">🍔 Platillos</a>
                <a href="/playground" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-orange-500 dark:hover:text-orange-400 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800/50">Playground</a>
            </nav>

            <div class="flex items-center gap-2">

                <button id="theme-toggle" class="relative w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95" aria-label="Cambiar tema">
                    <svg class="w-5 h-5 text-amber-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                    </svg>
                    <svg class="w-5 h-5 text-slate-700 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                </button>

                <button id="mobile-menu-btn" class="md:hidden w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <a href="/dashboard" class="hidden lg:inline-flex px-5 py-2.5 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-orange-500/30 transition-all duration-300 hover:scale-105 active:scale-95">
                    Empezar →
                </a>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950">
            <nav class="px-6 py-4 flex flex-col gap-2">
                <a href="/" class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">Inicio</a>
                <a href="/docs" class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">Documentación</a>
                <a href="/dashboard" class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">Dashboard</a>
                <a href="/admin/dishes" class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">🍔 Platillos</a>
                <a href="/playground" class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">Playground</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 dark:border-slate-800/50 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center">🍽️</div>
                        <span class="font-extrabold">Restaurante Escuela</span>
                    </div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Sistema de gestión académica. Proyecto del Profesor Melara.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Navegación</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Inicio</a></li>
                        <li><a href="/docs" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Documentación</a></li>
                        <li><a href="/dashboard" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Dashboard</a></li>
                        <li><a href="/admin/dishes" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Platillos</a></li>
                        <li><a href="/playground" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Playground</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Módulos</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/docs#sales" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Ventas</a></li>
                        <li><a href="/docs#inventory" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Inventario</a></li>
                        <li><a href="/docs#purchases" class="text-slate-600 dark:text-slate-300 hover:text-orange-500 transition">Compras</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400">Stack</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs">Laravel 12</span>
                        <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs">MySQL</span>
                        <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs">Sanctum</span>
                        <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs">Tailwind</span>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-200 dark:border-slate-800/50 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500 dark:text-slate-400">
                <p>© {{ date('Y') }} Restaurante Escuela · 111 endpoints REST</p>
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
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>