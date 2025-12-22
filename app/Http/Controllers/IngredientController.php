<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    // All ingredients list dikhana
    public function index()
    {
        $ingredients = Ingredient::all();
        $lowStockIngredients = Ingredient::lowStock()->get();
        return view('staff.ingredients.index', compact('ingredients', 'lowStockIngredients'));
    }

    // Create ingredient form dikhana
    public function create()
    {
        return view('staff.ingredients.create');
    }

    // New ingredient store karna
    public function store(Request $request)
    {
        $request->validate([
            'ingredientName' => 'required|string|max:100',
            'unit' => 'required|string|max:20',
            'quantityInStock' => 'required|numeric|min:0',
            'reorderLevel' => 'required|numeric|min:0',
            'pricePerUnit' => 'required|numeric|min:0',
        ]);

        // Map form fields to database columns
        Ingredient::create([
            'name' => $request->ingredientName,
            'unit' => $request->unit,
            'quantity' => $request->quantityInStock,
            'lowStockThreshold' => $request->reorderLevel,
        ]);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient created successfully!');
    }

    // Edit ingredient form dikhana
    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('staff.ingredients.edit', compact('ingredient'));
    }

    // Ingredient update karna
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $request->validate([
            'ingredientName' => 'required|string|max:100',
            'unit' => 'required|string|max:20',
            'quantityInStock' => 'required|numeric|min:0',
            'reorderLevel' => 'required|numeric|min:0',
            'pricePerUnit' => 'required|numeric|min:0',
        ]);

        // Map form fields to database columns
        $ingredient->update([
            'name' => $request->ingredientName,
            'unit' => $request->unit,
            'quantity' => $request->quantityInStock,
            'lowStockThreshold' => $request->reorderLevel,
        ]);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully!');
    }

    // Ingredient delete karna
    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully!');
    }
}
