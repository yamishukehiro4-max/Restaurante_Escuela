<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Restaurante Escuela</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' };</script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🍽️</text></svg>">
    <style>body { font-family: 'Inter', sans-serif; }</style>
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-white to-orange-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 min-h-screen flex items-center justify-center p-6">

    <!-- Fondo decorativo -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-orange-300/20 dark:bg-orange-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-red-300/20 dark:bg-red-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md">

        <!-- Logo y título -->
        <div class="text-center mb-8">
            <div class="inline-flex w-20 h-20 bg-gradient-to-br from-orange-400 via-red-500 to-pink-500 rounded-3xl items-center justify-center text-4xl shadow-2xl shadow-orange-500/30 mb-5">
                🍽️
            </div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white">Restaurante Escuela</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Iniciá sesión para continuar</p>
        </div>

        <!-- Formulario -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl p-8">

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900/50 rounded-xl">
                    <p class="text-sm text-red-700 dark:text-red-400 flex items-center gap-2">
                        <span>❌</span> {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Correo electrónico</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">📧</span>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="tu@correo.com"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Contraseña</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">🔒</span>
                        <input type="password" name="password" required
                            placeholder="••••••"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                    </div>
                </div>

                <div class="flex items-center mb-6">
                    <label class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded">
                        Recordarme
                    </label>
                </div>

                <button type="submit"
                    class="w-full px-6 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl font-bold shadow-lg shadow-orange-500/30 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                    🔑 Iniciar sesión
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-xs text-slate-400 dark:text-slate-500">
                © {{ date('Y') }} Restaurante Escuela · Sistema de gestión académica
            </p>
        </div>
    </div>

</body>
</html>