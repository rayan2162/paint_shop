<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = DB::table('orders')
            ->when($search, function ($query, $search) {
                return $query->where('product_name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('orders.index', compact('orders', 'search'));
    }

    public function store(Request $request)
    {
        DB::table('orders')->insert([
            'product_name' => $request->input('product_name'),
            'company' => $request->input('company'),
            'details' => $request->input('details'),
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order added successfully.');
    }

    public function edit($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        DB::table('orders')
            ->where('id', $id)
            ->update([
                'product_name' => $request->input('product_name'),
                'company' => $request->input('company'),
                'details' => $request->input('details'),
                'quantity' => $request->input('quantity'),
                'status' => $request->input('status'),
                'updated_at' => now(),
            ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}

