@extends('layouts.app')
@section('title', 'Materia Prima')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black">📦 Materia Prima</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Inventario de insumos</p>
        </div>
        <button onclick="document.getElementById('form-new').classList.toggle('hidden')" 
            class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg">
            + Nuevo insumo
        </button>
    </div>

    @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900/50 rounded-xl text-green-700 dark:text-green-400">✅ {{ session('success') }}</div>@endif

    <div id="form-new" class="hidden mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
        <h2 class="font-black mb-4">Crear materia prima</h2>
        <form method="POST" action="/admin/raw-materials" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <input name="name" placeholder="Nombre" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="code" placeholder="Código" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <select name="category_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <option value="">— Categoría —</option>
                @foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach
            </select>
            <input name="unit_measure" placeholder="Unidad (Libras, Kg, Unid.)" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <input name="stock_current" type="number" step="0.01" placeholder="Stock inicial" value="0" class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_perishable" value="1" class="w-5 h-5"> Perecedero</label>
            <button class="md:col-span-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold">Crear</button>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 md:px-6 py-4 text-left">Insumo</th>
                    <th class="px-4 md:px-6 py-4 text-left hidden md:table-cell">Categoría</th>
                    <th class="px-4 md:px-6 py-4 text-right">Stock</th>
                    <th class="px-4 md:px-6 py-4 text-center hidden md:table-cell">Tipo</th>
                    <th class="px-4 md:px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $m)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-4 md:px-6 py-4">
                            <p class="font-semibold text-sm">{{ $m->name }}</p>
                            <p class="text-xs text-slate-500 font-mono">{{ $m->code }}</p>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-sm hidden md:table-cell">{{ $m->category->name ?? '—' }}</td>
                        <td class="px-4 md:px-6 py-4 text-right font-bold text-sm {{ $m->stock_current < 10 ? 'text-red-500' : 'text-green-500' }}">
                            {{ $m->stock_current }} {{ $m->unit_measure }}
                        </td>
                        <td class="px-4 md:px-6 py-4 text-center text-xs hidden md:table-cell">
                            {{ $m->is_perishable ? '🔴 Perecedero' : '🟢 No perecedero' }}
                        </td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            <form method="POST" action="/admin/raw-materials/{{ $m->id }}" class="inline" onsubmit="return confirm('¿Eliminar insumo?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Sin insumos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $materials->links() }}</div>
</div>
@endsection