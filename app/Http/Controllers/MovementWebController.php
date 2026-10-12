<?php
namespace App\Http\Controllers;
use App\Models\RawMaterial;
use App\Models\RawMaterialMovement;
use App\Models\User;
use Illuminate\Http\Request;

class MovementWebController extends Controller
{
    public function index()
    {
        $movements = RawMaterialMovement::with(['rawMaterial','user'])->orderBy('created_at','desc')->paginate(20);
        $materials = RawMaterial::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('admin.movements.index', compact('movements','materials','users'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,id',
            'type' => 'required|in:Entrada,Salida,Merma_Clima,Autoconsumo',
            'quantity' => 'required|numeric|min:0.01',
            'reason' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);
        $material = RawMaterial::findOrFail($data['raw_material_id']);
        if (in_array($data['type'], ['Salida','Merma_Clima','Autoconsumo'])) {
            if ($material->stock_current < $data['quantity']) {
                return back()->with('error', "Stock insuficiente. Disponible: {$material->stock_current}");
            }
            $material->decrement('stock_current', $data['quantity']);
        } else {
            $material->increment('stock_current', $data['quantity']);
        }
        RawMaterialMovement::create($data);
        return back()->with('success', 'Movimiento registrado.');
    }
    public function destroy(RawMaterialMovement $movement)
    {
        $movement->delete();
        return back()->with('success', 'Movimiento eliminado.');
    }
}