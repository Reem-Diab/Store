<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // جلب المنتجات التي تخص المدير الحالي فقط باستخدام Auth::user()
        $products = Product::where('user_id', Auth::user()->id)->paginate(3);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // جلب الأصناف التي تخص المدير الحالي فقط باستخدام Auth::user()
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        // التحقق إذا كان المنتج بنفس الاسم موجودًا للمستخدم الحالي
        $existingProduct = Product::where('user_id', Auth::user()->id)
            ->where('name', $request->name)
            ->first();

        if ($existingProduct) {
            return redirect()->route('products.index')
                ->with('error', 'هذا المنتج موجود بالفعل لديك.');
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'user_id' => Auth::user()->id,  // ربط المنتج بالمستخدم الحالي
        ]);

        return redirect()->route('products.create')->with('success', 'تم إنشاء المنتج بنجاح!');
    }

    public function edit($id)
    {
        // جلب المنتج الذي يخص المدير الحالي فقط باستخدام Auth::user()
        $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح!');
    }

    public function destroy($id)
    {
        // حذف المنتج الذي يخص المدير الحالي فقط باستخدام Auth::user()
        $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح!');
    }
}
