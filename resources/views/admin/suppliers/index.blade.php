@extends('layouts.app')
@section('title', 'Proveedores')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black">🛒 Proveedores</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Gestión de proveedores</p>
        </div>
        <button onclick="document.getElementById('form-new').classList.toggle('hidden')" 
            class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg">
            + Nuevo proveedor
        </button>
    </div>

    @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900/50 rounded-xl text-green-700 dark:text-green-400">✅ {{ session('success') }}</div>@endif

    <div id="form-new" class="hidden mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
        <h2 class="font-black mb-4">Crear proveedor</h2>
        <form method="POST" action="/admin/suppliers" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <input name="name" placeholder="Nombre empresa" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="contact_name" placeholder="Contacto" class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="phone" placeholder="Teléfono" class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="email" type="email" placeholder="Email" class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="address" placeholder="Dirección" class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl md:col-span-2">
            <button class="md:col-span-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold">Crear</button>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 md:px-6 py-4 text-left">Proveedor</th>
                    <th class="px-4 md:px-6 py-4 text-left hidden md:table-cell">Contacto</th>
                    <th class="px-4 md:px-6 py-4 text-center">Estado</th>
                    <th class="px-4 md:px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $s)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-4 md:px-6 py-4">
                            <p class="font-semibold text-sm">{{ $s->name }}</p>
                            <p class="text-xs text-slate-500">{{ $s->email ?? '—' }}</p>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-sm hidden md:table-cell">
                            <p>{{ $s->contact_name ?? '—' }}</p>
                            <p class="text-xs text-slate-500">{{ $s->phone ?? '' }}</p>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-center">
                            <span class="px-2 py-1 {{ $s->status == 'Activo' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' }} rounded-full text-xs">{{ $s->status }}</span>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            <form method="POST" action="/admin/suppliers/{{ $s->id }}" class="inline" onsubmit="return confirm('¿Eliminar proveedor?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Sin proveedores.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $suppliers->links() }}</div>
</div>
@endsection