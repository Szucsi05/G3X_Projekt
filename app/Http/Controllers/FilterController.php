<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function show($category = null)
    {
        $categoryLabels = [
            'pc_games' => '🖥️ PC Játékok',
            'console_games' => '🎮 Konzol Játékok',
            'game_subscriptions' => '🎯 Játék Előfizetések',
            'software' => '💻 Szoftver',
        ];

        if ($category) {
            $products = Product::where('category', $category)->get();
            $categoryLabel = $categoryLabels[$category] ?? 'Összes Termék';
        } else {
            $products = Product::all();
            $category = null;
            $categoryLabel = 'Összes Termék';
        }

        return view('filter', compact('products', 'category', 'categoryLabel'));
    }
}
