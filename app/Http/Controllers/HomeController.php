<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\RawMaterial;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;

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

    public function docs()
    {
        return view('docs');
    }

    public function dashboard()
    {
        $totalSales  = Sale::sum('total_amount') ?? 0;
        $salesCount  = Sale::count();
        $averageSale = $salesCount > 0 ? $totalSales / $salesCount : 0;

        $topDishes = Dish::withSum('saleDetails', 'quantity')
            ->orderByDesc('sale_details_sum_quantity')
            ->take(5)
            ->get();

        $lowStock    = RawMaterial::where('stock_current', '<', 10)->get();
        $recentSales = Sale::with('user')->orderBy('sale_date', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalSales', 'salesCount', 'averageSale',
            'topDishes', 'lowStock', 'recentSales'
        ));
    }

    public function playground()
    {
        return view('playground');
    }
}