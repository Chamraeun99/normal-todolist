@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="app-brand">
        <img src="{{ asset('icon.png') }}" alt="PIC-DO" class="app-icon">
        <h1 class="page-title">EDIT TASK</h1>
    </div>

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
                <button type="submit" class="btn-save">
                    <span class="btn-spinner"></span>
                    <span class="btn-text">Save</span>
                </button>
                <a href="{{ route('todos.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
