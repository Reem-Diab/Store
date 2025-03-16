<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        // جلب جميع الفئات
        $categories = Category::all();

        // فلترة المنتجات حسب الفئة إذا كانت موجودة
        if ($request->has('category_id') && $request->category_id != '') {
            $products = Product::where('category_id', $request->category_id)->get();
        } else {
            $products = Product::all();
        }

        return view('home.index', compact('products', 'categories'));
    }
}

