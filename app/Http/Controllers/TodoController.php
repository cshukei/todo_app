<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderByDesc('created_at')
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
        ]);

        return redirect()->route('todos.index');
    }
}
