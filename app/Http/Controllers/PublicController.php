<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Homepage dikhana
    public function home()
    {
        $featuredProducts = Product::active()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        $products = $featuredProducts; // For backward compatibility
        
        return view('public.home', compact('featuredProducts', 'products'));
    }

    // Products catalog page dikhana
    public function products(Request $request)
    {
        $query = Product::active();

        // Category filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where('productName', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        $categories = Product::distinct()->pluck('category');

        return view('public.products', compact('products', 'categories'));
    }

    // Product details page dikhana
    public function productDetails($id)
    {
        $product = Product::active()->findOrFail($id);
        $relatedProducts = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('public.product-details', compact('product', 'relatedProducts'));
    }

    // About page dikhana
    public function about()
    {
        return view('public.about');
    }

    // Contact page dikhana
    public function contact()
    {
        return view('public.contact');
    }

    // Contact form submit karna
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Contact form processing (email send karna ya database mein save karna)
        
        return back()->with('success', 'Message sent successfully!');
    }
}
