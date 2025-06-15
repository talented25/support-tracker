<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    // ✅ List all activities with related logs and users
    public function index()
    {
        $activities = Activity::with('logs.user')->get();
        return view('activities.index', compact('activities'));
    }

    // ✅ Show form to create new activity
    public function create()
    {
        return view('activities.create');
    }

    // ✅ Store new activity
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Activity::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::id(), // ✅ Ensure authenticated user ID is stored
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    // ✅ Show form to edit activity
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    // ✅ Update activity
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $activity->update($request->only('title', 'description'));

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    // ✅ Delete activity
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
