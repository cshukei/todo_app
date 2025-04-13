<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('done', false)
                    ->where('active', true)
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
            'done' => false,
        ]);

        return redirect()->route('todos.index');
    }

    public function endSession()
    {
        Todo::where('active', true)->update(['active' => false]);
        return response()->json(['status' => 'session ended']);
    }

    public function done()
    {
        $todos = Todo::where('done', true)
                    ->where('active', true)
                    ->orderByDesc('created_at')
                    ->get();
        return view('doneTodo', compact('todos'));
    }

    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->done = true;
        $todo->save();

        return redirect()->route('todos.index');
    }

}
