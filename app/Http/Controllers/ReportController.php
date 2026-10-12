<?php
namespace App\Http\Controllers;
use App\Models\RawMaterial;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function salesPdf()
    {
        $sales = Sale::with(['user','details.dish'])->orderBy('sale_date','desc')->get();
        $pdf = Pdf::loadView('reports.sales-pdf', compact('sales'));
        return $pdf->download('ventas-'.date('Y-m-d').'.pdf');
    }
    public function stockPdf()
    {
        $materials = RawMaterial::with('category')->orderBy('name')->get();
        $pdf = Pdf::loadView('reports.stock-pdf', compact('materials'));
        return $pdf->download('stock-'.date('Y-m-d').'.pdf');
    }
}