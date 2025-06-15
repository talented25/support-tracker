<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function store(Request $request, Activity $activity)
    {
        $request->validate([
            'status' => 'required|in:done,pending',
            'remarks' => 'nullable|string',
        ]);

        $activity->logs()->create([
            'status'     => $request->status,
            'remarks'    => $request->remarks,
            'user_id'    => auth()->id(),
            'logged_at'  => now(),
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity log added.');
    }
}
