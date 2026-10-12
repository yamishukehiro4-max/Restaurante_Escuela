@extends('layouts.app')
@section('title', 'Recetas')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black">👨‍🍳 Recetas</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Vinculación platillos ↔ insumos</p>
        </div>
        <button onclick="document.getElementById('form-new').classList.toggle('hidden')" 
            class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg">
            + Nueva receta
        </button>
    </div>

    @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 rounded-xl text-green-700 dark:text-green-400">✅ {{ session('success') }}</div>@endif

    <div id="form-new" class="hidden mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
        <h2 class="font-black mb-4">Agregar receta</h2>
        <form method="POST" action="/admin/recipes" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <select name="dish_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <option value="">— Platillo —</option>
                @foreach($dishes as $d)<option value="{{ $d->id }}">{{ $d->name }}</option>@endforeach
            </select>
            <select name="raw_material_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <option value="">— Insumo —</option>
                @foreach($materials as $m)<option value="{{ $m->id }}">{{ $m->name }} ({{ $m->unit_measure }})</option>@endforeach
            </select>
            <input name="quantity_required" type="number" step="0.01" placeholder="Cantidad por platillo" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <button class="md:col-span-3 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold">Guardar</button>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 md:px-6 py-4 text-left">Platillo</th>
                    <th class="px-4 md:px-6 py-4 text-left">Insumo</th>
                    <th class="px-4 md:px-6 py-4 text-right">Cantidad</th>
                    <th class="px-4 md:px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes as $r)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-4 md:px-6 py-4 font-semibold text-sm">{{ $r->dish->name ?? '—' }}</td>
                        <td class="px-4 md:px-6 py-4 text-sm">{{ $r->rawMaterial->name ?? '—' }}</td>
                        <td class="px-4 md:px-6 py-4 text-right font-bold text-orange-500">{{ $r->quantity_required }} {{ $r->rawMaterial->unit_measure ?? '' }}</td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            <form method="POST" action="/admin/recipes/{{ $r->id }}" onsubmit="return confirm('¿Eliminar?')" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Sin recetas cargadas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $recipes->links() }}</div>
</div>
@endsection