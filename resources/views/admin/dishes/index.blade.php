@extends('layouts.app')

@section('title', 'Gestión de Platillos')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-black">🍔 Platillos</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Gestión de platillos del restaurante</p>
        </div>
        <a href="/admin/dishes/create" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg shadow-orange-500/30 hover:scale-105 transition">
            + Nuevo platillo
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900/50 rounded-xl text-green-700 dark:text-green-400">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-6 py-4 text-left">Platillo</th>
                    <th class="px-6 py-4 text-left">Categoría</th>
                    <th class="px-6 py-4 text-right">Precio</th>
                    <th class="px-6 py-4 text-center">Estado</th>
                    <th class="px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dishes as $dish)
                    <tr class="border-t border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <td class="px-6 py-4">
                            <p class="font-semibold">{{ $dish->name }}</p>
                            <p class="text-xs text-slate-500">{{ Str::limit($dish->description, 50) }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $dish->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-right font-bold text-orange-500">${{ number_format($dish->price, 2) }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($dish->is_active)
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs">Activo</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full text-xs">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="/admin/dishes/{{ $dish->id }}/edit" class="text-blue-500 hover:underline text-sm mr-3">Editar</a>
                            <form action="/admin/dishes/{{ $dish->id }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar {{ $dish->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Sin platillos. Creá el primero.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $dishes->links() }}</div>
</div>
@endsection