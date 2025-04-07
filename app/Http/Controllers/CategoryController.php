<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (Category::where('user_id', Auth::id())->where('name', $value)->exists()) {
                        $fail('This category name already exists.');
                    }
                },
            ],
        ]);

        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.create')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($category) {
                    if (Category::where('user_id', Auth::id())
                        ->where('name', $value)
                        ->where('id', '!=', $category->id)
                        ->exists()) {
                        $fail('This category name already exists.');
                    }
                },
            ],
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}

