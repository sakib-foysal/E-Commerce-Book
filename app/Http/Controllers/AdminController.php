<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'recentOrders',
            'recentProducts'
        ));
    }
    // ---------- PRODUCT SECTION ----------
    public function addProduct()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Attach categories (many-to-many)
        $product->categories()->attach($request->category_id);

        // Upload multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                Image::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.list')->with('success', 'Product added successfully!');
    }

    public function productList()
    {
        $products = Product::with('categories', 'images')->get();
        return view('admin.product.list', compact('products'));
    }

    public function editProduct($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Update category relations
        $product->categories()->sync($request->category_id);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                Image::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.list')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->images()->delete();
        $product->delete();
        return redirect()->route('admin.product.list')->with('success', 'Product deleted successfully!');
    }

    // ---------- CATEGORY SECTION ----------
    public function addCategory()
    {
        return view('admin.category.add');
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create(['name' => $request->name, 'description' => $request->description]);
        return redirect()->route('admin.category.list')->with('success', 'Category added successfully!');
    }

    public function categoryList()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }
}
