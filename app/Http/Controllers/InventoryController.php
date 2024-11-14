<?php

// InventoryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        // Handle search
        $search = $request->input('search');
        
        // Fetch products, with optional search filter
        $products = DB::table('inventory')
            ->when($search, function ($query, $search) {
                return $query->where('product_name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('inventory.index', compact('products', 'search'));
    }

    public function store(Request $request)
    {
        // Insert new product into the database
        DB::table('inventory')->insert([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'company_name' => $request->input('company_name'),
            'quantity' => $request->input('quantity'),
            'buy_price' => $request->input('buy_price'),
            'sell_price' => $request->input('sell_price'),
            'stock_info' => $request->input('stock_info'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Product added successfully.');
    }

    public function destroy($id)
    {
        DB::table('inventory')->where('id', $id)->delete();
        return redirect()->route('inventory.index')->with('success', 'Product deleted successfully.');
    }

    public function edit($id)
    {
        // Get the product by id from the database
        $product = DB::table('inventory')->where('id', $id)->first();

        // Check if product exists
        if (!$product) {
            return redirect()->route('inventory.index')->with('error', 'Product not found');
        }

        // Pass product data to the edit view
        return view('inventory.edit', compact('product'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'company_name' => 'required',
            'quantity' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'stock_info' => 'nullable|string',
        ]);

        $updated = DB::table('inventory')
            ->where('id', $id)
            ->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'company_name' => $request->company_name,
                'quantity' => $request->quantity,
                'buy_price' => $request->buy_price,
                'sell_price' => $request->sell_price,
                'stock_info' => $request->stock_info,
            ]);

        if ($updated) {
            return redirect()->route('inventory.index')->with('success', 'Product updated successfully');
        }

        return redirect()->route('inventory.index')->with('error', 'Failed to update product');
    }

}
