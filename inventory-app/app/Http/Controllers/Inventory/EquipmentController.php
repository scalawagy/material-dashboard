<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('supplier')->get();
        return view('inventory.equipment.index', compact('equipment'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'serial_number' => 'required|string|unique:equipment',
            'supplier_id' => 'nullable|integer',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',
            'warranty_months' => 'nullable|integer',
        ]);

        Equipment::create($data);

        return redirect()->back()->with('status', 'Equipment added');
    }
}

