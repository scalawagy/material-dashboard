<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ItemRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('assignable')
            ->where('user_id', Auth::id())
            ->get();

        $requests = ItemRequest::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('staff.dashboard', compact('assignments', 'requests'));
    }
}

