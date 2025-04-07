<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        // جلب أسماء الفئات بدون تكرار حسب الاسم فقط
        $categories = Category::select('id', 'name')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                      ->from('categories')
                      ->groupBy('name');
            })
            ->get();

        // فلترة المنتجات حسب الفئة إذا كانت موجودة
        if ($request->has('category_id') && $request->category_id != '') {
            $products = Product::where('category_id', $request->category_id)->get();
        } else {
            $products = Product::all();
        }

        return view('home.index', compact('products', 'categories'));
    }
}
