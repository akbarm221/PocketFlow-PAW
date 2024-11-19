<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        return view('goals.index', compact('goals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal' => 'required|string|max:255',
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'goals' => $request->goal, // Disesuaikan dengan kolom 'goals'
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal added successfully!');
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'goal' => 'required|string|max:255',
        ]);

        $goal->update([
            'goals' => $request->goal, // Disesuaikan dengan kolom 'goals'
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully!');
    }

    public function destroy($id)
    {
        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully!');
    }

    public function toggle(Request $request, $id)
{
    // Cari goal berdasarkan ID dan user yang sedang login
    $goal = Goal::where('user_id', Auth::id())->findOrFail($id);

    // Perbarui status is_completed berdasarkan nilai dari checkbox
    $goal->update([
        'is_completed' => $request->is_completed,
    ]);

    // Kembalikan respons JSON untuk AJAX
    return response()->json(['message' => 'Goal status updated successfully!']);
}

public function toggleCompletion(Request $request, $id)
{
    $goal = Goal::where('user_id', Auth::id())->findOrFail($id);
    $goal->is_completed = $request->is_completed;
    $goal->save();

    return response()->json(['success' => true, 'message' => 'Goal completion status updated.']);
}


}
