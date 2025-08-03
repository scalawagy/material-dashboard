<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    public function signOff(Assignment $assignment)
    {
        Gate::authorize('update', $assignment);

        $assignment->update([
            'signed_off_at' => now(),
            'condition' => 'Good',
        ]);

        return redirect()->back()->with('status', 'Assignment signed off');
    }
}

