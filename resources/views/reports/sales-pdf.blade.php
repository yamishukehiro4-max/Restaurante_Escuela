<!DOCTYPE html><html><head><meta charset="UTF-8"><style>
body{font-family:sans-serif;font-size:12px}h1{color:#F97316}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{border:1px solid #ccc;padding:8px;text-align:left}
th{background:#F97316;color:white}.total{font-weight:bold;background:#f0f0f0}
</style></head><body>
<h1>🍽️ Restaurante Escuela — Reporte de Ventas</h1>
<p>Generado: {{ now()->format('d/m/Y H:i') }}</p>
<table><thead><tr><th>#</th><th>Cajero</th><th>Fecha</th><th>Método</th><th>Total</th></tr></thead>
<tbody>
@foreach($sales as $s)
<tr><td>#{{ $s->id }}</td><td>{{ $s->user->name ?? '—' }}</td><td>{{ \Carbon\Carbon::parse($s->sale_date)->format('d/m/Y H:i') }}</td><td>{{ $s->payment_method }}</td><td>${{ number_format($s->total_amount,2) }}</td></tr>
@endforeach
<tr class="total"><td colspan="4" style="text-align:right">TOTAL:</td><td>${{ number_format($sales->sum('total_amount'),2) }}</td></tr>
</tbody></table></body></html>