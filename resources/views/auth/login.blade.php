@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="app-brand">
        <div class="app-icon-wrap">
            <img src="{{ asset('icon.png') }}" alt="PIC-DO" class="app-icon">
        </div>
        <h1 class="page-title">MY TO DO LIST</h1>
        <p class="page-subtitle">// auth.secure_login()</p>
    </div>

    <div class="glass-card edit-card">
        <div class="login-terminal">
            <span>$</span> pic-do authenticate --password ****
        </div>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="password">Access Key</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                    autofocus
                >
                @error('password')
                    <div class="field-error" style="margin: 0.75rem 0 0;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <span class="btn-spinner"></span>
                    <span class="btn-text">🤖 Login</span>
                </button>
            </div>
        </form>
    </div>
@endsection
