<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        $todos = Todo::orderBy('completed')->orderByDesc('created_at')->get();

        return view('todos.index', [
            'todos' => $todos,
            'doneCount' => $todos->where('completed', true)->count(),
            'onProgressCount' => $todos->where('completed', false)->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'note' => ['required', 'string', 'max:255'],
        ]);

        Todo::create($validated);

        return redirect()->route('todos.index');
    }

    public function edit(Todo $todo): View
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo): RedirectResponse
    {
        $validated = $request->validate([
            'note' => ['required', 'string', 'max:255'],
        ]);

        $todo->update($validated);

        return redirect()->route('todos.index');
    }

    public function toggle(Todo $todo): RedirectResponse
    {
        $todo->update(['completed' => ! $todo->completed]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $todo->delete();

        return redirect()->route('todos.index');
    }
}
