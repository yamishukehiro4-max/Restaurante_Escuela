<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\RawMaterial;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'roles'         => Role::count(),
            'users'         => User::count(),
            'dishes'        => Dish::count(),
            'raw_materials' => RawMaterial::count(),
            'suppliers'     => Supplier::count(),
            'sales_today'   => Sale::whereDate('sale_date', today())->count(),
            'sales_total'   => Sale::sum('total_amount'),
        ];
        return view('home', compact('stats'));
    }

    public function docs() { return view('docs'); }
    public function playground() { return view('playground'); }

    public function dashboard()
    {
        $totalSales  = Sale::sum('total_amount') ?? 0;
        $salesCount  = Sale::count();
        $averageSale = $salesCount > 0 ? $totalSales / $salesCount : 0;

        $topDishes = Dish::withSum('saleDetails', 'quantity')
            ->orderByDesc('sale_details_sum_quantity')
            ->take(5)->get();

        $lowStock    = RawMaterial::where('stock_current', '<', 10)->get();
        $recentSales = Sale::with('user')->orderBy('sale_date', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalSales', 'salesCount', 'averageSale',
            'topDishes', 'lowStock', 'recentSales'
        ));
    }

    public function chartData()
    {
        // Ventas por día (últimos 7 días)
        $salesByDay = Sale::select(
                DB::raw('DATE(sale_date) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('sale_date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Platillos por categoría
        $dishesByCategory = DB::table('dishes')
            ->join('dish_categories', 'dishes.category_id', '=', 'dish_categories.id')
            ->select('dish_categories.name', DB::raw('COUNT(*) as total'))
            ->groupBy('dish_categories.name')
            ->get();

        return response()->json([
            'sales_by_day'       => $salesByDay,
            'dishes_by_category' => $dishesByCategory,
        ]);
    }
}