<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'item_type' => 'required|string',
            'item_id'   => 'required|integer',
            'quantity'  => 'required|integer|min:1',
            'reason'    => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        ItemRequest::create($data);

        return redirect()->back()->with('status', 'Request submitted');
    }
}

