<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos;
        return view('home', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        Todo::create([
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return back()->with('success', 'เพิ่มงานเรียบร้อย');
    }
    public function destroy(Todo $todo)
    {
        if ($todo->user_id == Auth::id()) {
            $todo->delete();
        }
        return back()->with('success', 'ลบงานเรียบร้อย');
    }
}
