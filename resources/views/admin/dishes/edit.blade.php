@extends('layouts.app')

@section('title', 'Editar Platillo')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">

    <div class="mb-8">
        <a href="/admin/dishes" class="text-sm text-slate-500 hover:text-orange-500">← Volver</a>
        <h1 class="text-4xl font-black mt-2">Editar platillo</h1>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8">
        <form method="POST" action="/admin/dishes/{{ $dish->id }}">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-2">Nombre del platillo</label>
                    <input type="text" name="name" value="{{ old('name', $dish->name) }}" required
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Categoría</label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:outline-none">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $dish->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Descripción</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:outline-none">{{ old('description', $dish->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Precio (USD)</label>
                    <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $dish->price) }}" required
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $dish->is_active ? 'checked' : '' }} class="w-5 h-5 rounded">
                        <span class="text-sm font-semibold">Platillo activo</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="flex-1 px-6 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold shadow-lg shadow-orange-500/30 hover:scale-[1.02] transition">
                    💾 Guardar cambios
                </button>
                <a href="/admin/dishes" class="px-6 py-4 bg-slate-100 dark:bg-slate-800 rounded-xl font-bold">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection