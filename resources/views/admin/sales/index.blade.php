@extends('layouts.app')
@section('title', 'Ventas')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black">💰 Ventas</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Registrar y ver ventas</p>
        </div>
        <button onclick="document.getElementById('form-new').classList.toggle('hidden')" 
            class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg">
            + Nueva venta
        </button>
    </div>

    @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-950/30 border border-green-200 rounded-xl text-green-700 dark:text-green-400">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="mb-4 p-4 bg-red-50 dark:bg-red-950/30 border border-red-200 rounded-xl text-red-700 dark:text-red-400">❌ {{ session('error') }}</div>@endif

    <div id="form-new" class="hidden mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6">
        <h2 class="font-black mb-4">Registrar venta</h2>
        <form method="POST" action="/admin/sales" id="sale-form">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <select name="user_id" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                    <option value="">— Cajero —</option>
                    @foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach
                </select>
                <input type="datetime-local" name="sale_date" value="{{ date('Y-m-d\TH:i') }}" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                <select name="payment_method" required class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                    <option value="Efectivo">Efectivo</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Tarjeta">Tarjeta</option>
                </select>
            </div>

            <div id="items-container" class="space-y-3 mb-4">
                <div class="grid grid-cols-12 gap-3 items-end item-row">
                    <div class="col-span-7">
                        <label class="block text-xs font-semibold mb-1">Platillo</label>
                        <select name="items[0][dish_id]" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                            <option value="">— Seleccioná —</option>
                            @foreach($dishes as $d)<option value="{{ $d->id }}">{{ $d->name }} - ${{ number_format($d->price, 2) }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-span-3">
                        <label class="block text-xs font-semibold mb-1">Cantidad</label>
                        <input type="number" name="items[0][quantity]" value="1" min="1" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                    </div>
                    <div class="col-span-2">
                        <button type="button" onclick="this.closest('.item-row').remove()" class="w-full px-4 py-3 bg-red-100 text-red-600 rounded-xl font-bold text-sm">X</button>
                    </div>
                </div>
            </div>

            <button type="button" onclick="addItem()" class="mb-4 px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-xl text-sm font-semibold">+ Agregar platillo</button>

            <button class="w-full px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold">💰 Registrar venta</button>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 md:px-6 py-4 text-left">#</th>
                    <th class="px-4 md:px-6 py-4 text-left">Cajero</th>
                    <th class="px-4 md:px-6 py-4 text-left hidden md:table-cell">Fecha</th>
                    <th class="px-4 md:px-6 py-4 text-right">Total</th>
                    <th class="px-4 md:px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $s)
                    <tr class="border-t border-slate-100 dark:border-slate-800">
                        <td class="px-4 md:px-6 py-4 font-mono text-sm">#{{ $s->id }}</td>
                        <td class="px-4 md:px-6 py-4 text-sm">{{ $s->user->name ?? '—' }}</td>
                        <td class="px-4 md:px-6 py-4 text-sm text-slate-500 hidden md:table-cell">{{ \Carbon\Carbon::parse($s->sale_date)->format('d/m/Y H:i') }}</td>
                        <td class="px-4 md:px-6 py-4 text-right font-bold text-orange-500">${{ number_format($s->total_amount, 2) }}</td>
                        <td class="px-4 md:px-6 py-4 text-right">
                            <form method="POST" action="/admin/sales/{{ $s->id }}" onsubmit="return confirm('¿Eliminar?')" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Sin ventas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $sales->links() }}</div>
</div>

<script>
let itemIndex = 1;
function addItem() {
    const container = document.getElementById('items-container');
    const html = `
        <div class="grid grid-cols-12 gap-3 items-end item-row">
            <div class="col-span-7">
                <select name="items[${itemIndex}][dish_id]" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
                    <option value="">— Seleccioná —</option>
                    @foreach($dishes as $d)<option value="{{ $d->id }}">{{ $d->name }} - ${{ number_format($d->price, 2) }}</option>@endforeach
                </select>
            </div>
            <div class="col-span-3">
                <input type="number" name="items[${itemIndex}][quantity]" value="1" min="1" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl">
            </div>
            <div class="col-span-2">
                <button type="button" onclick="this.closest('.item-row').remove()" class="w-full px-4 py-3 bg-red-100 text-red-600 rounded-xl font-bold text-sm">X</button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    itemIndex++;
}
</script>
@endsection