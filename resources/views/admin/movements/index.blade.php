@extends('layouts.app')
@section('title','Kardex')
@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div><h1 class="text-4xl font-black">📊 Kardex</h1><p class="text-slate-500 mt-1">Movimientos de inventario</p></div>
        <button onclick="document.getElementById('form-new').classList.toggle('hidden')" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg">+ Nuevo movimiento</button>
    </div>
    @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 rounded-xl text-green-700">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="mb-4 p-4 bg-red-50 dark:bg-red-950/30 border border-red-200 rounded-xl text-red-700">❌ {{ session('error') }}</div>@endif
    <div id="form-new" class="hidden mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
        <h2 class="font-black mb-4">Registrar movimiento</h2>
        <form method="POST" action="/admin/movements" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <select name="raw_material_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <option value="">— Insumo —</option>
                @foreach($materials as $m)<option value="{{ $m->id }}">{{ $m->name }} (Stock: {{ $m->stock_current }})</option>@endforeach
            </select>
            <select name="type" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <option value="Entrada">✅ Entrada</option>
                <option value="Salida">📤 Salida</option>
                <option value="Merma_Clima">🌧️ Merma por clima</option>
                <option value="Autoconsumo">🍽️ Autoconsumo</option>
            </select>
            <input name="quantity" type="number" step="0.01" placeholder="Cantidad" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <select name="user_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <option value="">— Responsable —</option>
                @foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach
            </select>
            <input name="reason" placeholder="Motivo (opcional)" class="md:col-span-2 px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            <button class="md:col-span-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold">Registrar</button>
        </form>
    </div>
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr><th class="px-6 py-4 text-left">Insumo</th><th class="px-6 py-4 text-left">Tipo</th><th class="px-6 py-4 text-right">Cantidad</th><th class="px-6 py-4 text-left hidden md:table-cell">Motivo</th><th class="px-6 py-4 text-right">Acción</th></tr>
            </thead>
            <tbody>
                @forelse($movements as $m)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-6 py-4 text-sm font-semibold">{{ $m->rawMaterial->name ?? '—' }}</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-xs {{ $m->type == 'Entrada' ? 'bg-green-100 text-green-700' : ($m->type == 'Autoconsumo' ? 'bg-purple-100 text-purple-700' : 'bg-red-100 text-red-700') }}">{{ $m->type }}</span></td>
                        <td class="px-6 py-4 text-right text-sm font-bold">{{ $m->quantity }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500 hidden md:table-cell">{{ $m->reason ?? '—' }}</td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="/admin/movements/{{ $m->id }}" class="inline" onsubmit="return confirm('¿Eliminar?')">@csrf @method('DELETE')<button class="text-red-500 text-sm">Eliminar</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Sin movimientos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $movements->links() }}</div>
</div>
@endsection