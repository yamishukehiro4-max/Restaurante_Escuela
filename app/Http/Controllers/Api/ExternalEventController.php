<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExternalEvent;
use Illuminate\Http\Request;

class ExternalEventController extends Controller
{
    public function index()
    {
        return response()->json(ExternalEvent::with('approver')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'client_name'  => 'required|string|max:150',
            'client_phone' => 'nullable|string|max:30',
            'event_date'   => 'required|date',
            'guest_count'  => 'required|integer|min:1',
            'quoted_price' => 'required|numeric|min:0',
            'status'       => 'in:Solicitado,Aprobado,Rechazado,Ejecutado',
            'approved_by'  => 'nullable|exists:users,id',
            'notes'        => 'nullable|string',
        ]);
        return response()->json(ExternalEvent::create($data)->load('approver'), 201);
    }

    public function show(ExternalEvent $externalEvent)
    {
        return response()->json($externalEvent->load('approver'), 200);
    }

    public function update(Request $request, ExternalEvent $externalEvent)
    {
        $data = $request->validate([
            'name'        => 'sometimes|string|max:150',
            'status'      => 'sometimes|in:Solicitado,Aprobado,Rechazado,Ejecutado',
            'approved_by' => 'nullable|exists:users,id',
            'notes'       => 'nullable|string',
        ]);
        $externalEvent->update($data);
        return response()->json($externalEvent->load('approver'), 200);
    }

    public function destroy(ExternalEvent $externalEvent)
    {
        $externalEvent->delete();
        return response()->json(['message' => 'Evento eliminado'], 200);
    }

    public function approve(Request $request, ExternalEvent $externalEvent)
    {
        $data = $request->validate([
            'approved_by' => 'required|exists:users,id',
        ]);
        $externalEvent->update([
            'status'      => 'Aprobado',
            'approved_by' => $data['approved_by'],
        ]);
        return response()->json($externalEvent->load('approver'), 200);
    }
}