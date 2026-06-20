@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <h1 class="page-title">EDIT TASK</h1>

    <div class="edit-card">
        <form action="{{ route('todos.update', $todo) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="note">note</label>
                <input
                    type="text"
                    id="note"
                    name="note"
                    value="{{ old('note', $todo->note) }}"
                    required
                    autofocus
                >
                @error('note')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ route('todos.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
