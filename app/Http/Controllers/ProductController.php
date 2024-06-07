<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        return view('Admin.Product.index', [
            'products' => Product::paginate(10),
        ]);
    }

    public function create()
    {
        return view('Admin.Product.form', [
            'product' => new Product(),
            'categories' => Category::all(),
        ]);
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png|max:5048',
        ]);

        // if ($request->has('image')) {
        //     $filePath = $request->file('image')->store('images', 'public');
        //     $validated['image'] = $filePath;
        //     Log::info('File uploaded to: ' . $filePath); // Log the file path
        // }
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $fileName = time() . '.' . $extension;
            $path = 'public/images/';
            $file->move($path, $fileName);
        }

        $product = Product::create($validated);
        Log::info('Product created with data: ', $product->toArray()); // Log the product data        

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return view('Admin.Product.form', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(UpdateProductCategoryRequest $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $filePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $filePath;
            Log::info('File uploaded to: ' . $filePath); // Log the file path
        }

        $product->update($validated);
        Log::info('Product updated with data: ', $product->toArray()); // Log the product data

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}

