<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DueController extends Controller
{
    // Display the list of dues and handle search
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dues = DB::table('due')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('due.index', compact('dues', 'search'));
    }

    // Store a new due record
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_no' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'info' => 'nullable|string',
        ]);

        DB::table('due')->insert([
            'name' => $request->input('name'),
            'phone_no' => $request->input('phone_no'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'info' => $request->input('info'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('due.index')->with('success', 'Due added successfully.');
    }

    // Delete a due record
    public function destroy($id)
    {
        DB::table('due')->where('id', $id)->delete();
        return redirect()->route('due.index')->with('success', 'Due deleted successfully.');
    }

    public function edit($id)
{
    $due = DB::table('due')->where('id', $id)->first();

    if (!$due) {
        return redirect()->route('due.index')->with('error', 'Due record not found');
    }

    return view('due.edit', compact('due'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'phone_no' => 'required',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'info' => 'nullable|string',
    ]);

    DB::table('due')
        ->where('id', $id)
        ->update([
            'name' => $request->input('name'),
            'phone_no' => $request->input('phone_no'),
            'amount' => $request->input('amount'),
            'info' => $request->input('info'),
            'date' => $request->input('date'),
            'updated_at' => now(),
        ]);

    return redirect()->route('due.index')->with('success', 'Due updated successfully');
}

}
