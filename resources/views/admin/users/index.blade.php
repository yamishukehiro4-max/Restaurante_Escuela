@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black">👥 Usuarios</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Gestión de usuarios del sistema</p>
        </div>
        <button onclick="document.getElementById('form-new').classList.toggle('hidden')" 
            class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg">
            + Nuevo usuario
        </button>
    </div>

    @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900/50 rounded-xl text-green-700 dark:text-green-400">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="mb-4 p-4 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900/50 rounded-xl text-red-700 dark:text-red-400">❌ {{ session('error') }}</div>@endif

    <div id="form-new" class="hidden mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
        <h2 class="font-black mb-4">Crear usuario</h2>
        <form method="POST" action="/admin/users" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <input name="name" placeholder="Nombre completo" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="email" type="email" placeholder="Email" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="nie" placeholder="NIE (opcional)" class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="password" type="password" placeholder="Contraseña" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <select name="role_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl md:col-span-2">
                <option value="">— Rol —</option>
                @foreach($roles as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>
            <button class="md:col-span-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold">Crear</button>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 md:px-6 py-4 text-left">Usuario</th>
                    <th class="px-4 md:px-6 py-4 text-left hidden md:table-cell">NIE</th>
                    <th class="px-4 md:px-6 py-4 text-left">Rol</th>
                    <th class="px-4 md:px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-4 md:px-6 py-4">
                            <p class="font-semibold text-sm">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-sm font-mono hidden md:table-cell">{{ $user->nie ?? '—' }}</td>
                        <td class="px-4 md:px-6 py-4">
                            <span class="px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-full text-xs">{{ $user->role->name ?? 'Sin rol' }}</span>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            <form method="POST" action="/admin/users/{{ $user->id }}" class="inline" onsubmit="return confirm('¿Eliminar usuario?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Sin usuarios.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
</div>
@endsection