<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('active', true)
                    ->orderByDesc('created_at')
                    ->get();
        return view('todo', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string',
        ]);

        Todo::create([
            'todo' => $request->todo,
            'active' => true,
        ]);

        return redirect()->route('todos.index');
    }

    public function endSession()
    {
        Todo::where('active', true)->update(['active' => false]);
        return response()->json(['status' => 'session ended']);
    }
}
