@extends('layouts.app')

@section('title', 'My To Do List')

@section('content')
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-cancel" style="cursor: pointer;">Logout</button>
        </form>
    </div>

    <div class="app-brand">
        <img src="{{ asset('icon.png') }}" alt="PIC-DO" class="app-icon">
        <h1 class="page-title">MY TO DO LIST</h1>
    </div>

    <form action="{{ route('todos.store') }}" method="POST" class="add-form">
        @csrf
        <input
            type="text"
            name="note"
            placeholder="Masukan to do list"
            value="{{ old('note') }}"
            autofocus
            required
        >
        <button type="submit" class="btn-save">
            <span class="btn-spinner"></span>
            <span class="btn-text">Save</span>
        </button>
    </form>

    @if ($errors->any())
        <div class="field-error">{{ $errors->first() }}</div>
    @endif

    <div class="stats">
        <div class="stat-box stat-done">Todo Done : {{ $doneCount }}</div>
        <div class="stat-box stat-progress">Todo On Progress : {{ $onProgressCount }}</div>
    </div>

    <div class="task-table">
        <div class="task-header">
            <span>note</span>
            <span>action</span>
        </div>

        @forelse ($todos as $todo)
            <div class="task-row {{ $todo->completed ? 'done' : '' }}">
                <span class="task-note">{{ $todo->note }}</span>

                <div class="task-actions">
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn action-delete" title="Delete">
                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                        </button>
                    </form>

                    <a href="{{ route('todos.edit', $todo) }}" class="action-btn action-edit" title="Edit">
                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </a>

                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="action-btn action-done {{ $todo->completed ? 'done' : '' }}" title="Mark done">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">No tasks yet. Add one above.</div>
        @endforelse
    </div>
@endsection
