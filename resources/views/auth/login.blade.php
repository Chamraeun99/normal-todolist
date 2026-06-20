@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1 class="page-title">MY TO DO LIST</h1>

    <div class="edit-card" style="max-width: 420px; margin: 0 auto;">
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                    autofocus
                >
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Login</button>
            </div>
        </form>
    </div>
@endsection
