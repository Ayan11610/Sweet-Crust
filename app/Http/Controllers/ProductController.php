<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // All products list dikhana (with DataTables)
    public function index()
    {
        $products = Product::all();
        return view('staff.products.index', compact('products'));
    }

    // Create product form dikhana
    public function create()
    {
        return view('staff.products.create');
    }

    // New product store karna
    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:100',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'stockQuantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageUrl = null;
        
        // Image upload karna
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $imageUrl = 'images/products/' . $imageName;
        }

        // Product create karna
        Product::create([
            'productName' => $request->productName,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'stockQuantity' => $request->stockQuantity,
            'imageUrl' => $imageUrl,
            'isActive' => true,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    // Edit product form dikhana
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('staff.products.edit', compact('product'));
    }

    // Product update karna
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'productName' => 'required|string|max:100',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'stockQuantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageUrl = $product->imageUrl;

        // Agar new image upload ho rahi hai
        if ($request->hasFile('image')) {
            // Old image delete karna
            if ($product->imageUrl && file_exists(public_path($product->imageUrl))) {
                unlink(public_path($product->imageUrl));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $imageUrl = 'images/products/' . $imageName;
        }

        // Product update karna
        $product->update([
            'productName' => $request->productName,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'stockQuantity' => $request->stockQuantity,
            'imageUrl' => $imageUrl,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // Product delete karna
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Image delete karna
        if ($product->imageUrl && file_exists(public_path($product->imageUrl))) {
            unlink(public_path($product->imageUrl));
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
