<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        $supplies = Supply::with('supplier')->get();
        return view('inventory.supplies.index', compact('supplies'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:supplies',
            'quantity' => 'required|integer',
            'min_threshold' => 'nullable|integer',
            'supplier_id' => 'nullable|integer',
        ]);

        Supply::create($data);

        return redirect()->back()->with('status', 'Supply added');
    }
}

