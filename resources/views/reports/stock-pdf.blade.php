<!DOCTYPE html><html><head><meta charset="UTF-8"><style>
body{font-family:sans-serif;font-size:12px}h1{color:#F97316}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{border:1px solid #ccc;padding:8px;text-align:left}
th{background:#F97316;color:white}.low{color:red;font-weight:bold}
</style></head><body>
<h1>📦 Restaurante Escuela — Inventario</h1>
<p>Generado: {{ now()->format('d/m/Y H:i') }}</p>
<table><thead><tr><th>Código</th><th>Insumo</th><th>Categoría</th><th>Stock</th><th>Tipo</th></tr></thead>
<tbody>
@foreach($materials as $m)
<tr><td>{{ $m->code }}</td><td>{{ $m->name }}</td><td>{{ $m->category->name ?? '—' }}</td><td class="{{ $m->stock_current < 10 ? 'low' : '' }}">{{ $m->stock_current }} {{ $m->unit_measure }}</td><td>{{ $m->is_perishable ? 'Perecedero' : 'No perecedero' }}</td></tr>
@endforeach
</tbody></table></body></html>