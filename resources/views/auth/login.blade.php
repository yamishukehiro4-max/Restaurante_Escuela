<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Restaurante Escuela</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' };</script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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

    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <div class="inline-flex w-16 h-16 bg-gradient-to-br from-orange-400 via-red-500 to-pink-500 rounded-2xl items-center justify-center text-3xl shadow-xl shadow-orange-500/30 mb-4">🍽️</div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white">Restaurante Escuela</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Iniciá sesión para continuar</p>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl p-8">

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900/50 rounded-xl">
                    <p class="text-sm text-red-700 dark:text-red-400">❌ {{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Email</label>
                    <input type="email" name="email" value="{{ old('email', 'lidia@restaurante.edu.sv') }}" required autofocus
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2 text-slate-700 dark:text-slate-300">Contraseña</label>
                    <input type="password" name="password" value="123456" required
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                        <input type="checkbox" name="remember" class="rounded">
                        Recordarme
                    </label>
                </div>

                <button type="submit"
                    class="w-full px-6 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl font-bold shadow-lg shadow-orange-500/30 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                    🔑 Iniciar sesión
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-800">
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Usuarios de prueba</p>
                <div class="space-y-1 text-xs font-mono text-slate-600 dark:text-slate-400">
                    <p>admin@restaurante.edu.sv <span class="text-slate-400">— Admin</span></p>
                    <p>chef@restaurante.edu.sv <span class="text-slate-400">— Chef</span></p>
                    <p>lidia@restaurante.edu.sv <span class="text-slate-400">— Compras</span></p>
                    <p>caja@restaurante.edu.sv <span class="text-slate-400">— Caja</span></p>
                    <p class="text-orange-500 font-bold mt-2">Contraseña: 123456</p>
                </div>
            </div>
        </div>

        <p class="text-center text-xs text-slate-400 dark:text-slate-500 mt-6">© {{ date('Y') }} Restaurante Escuela</p>
    </div>

</body>
</html>