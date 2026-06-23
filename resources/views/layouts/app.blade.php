<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PIC-DO')</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            color: #333;
            min-height: 100vh;
            padding: 2.5rem 1rem 3rem;
        }

        .container {
            max-width: 720px;
            margin: 0 auto;
        }

        .page-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            background: linear-gradient(90deg, #00bcd4, #7c4dff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
        }

        .app-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 2rem;
        }

        .app-brand .page-title {
            margin-bottom: 0;
        }

        .app-icon {
            width: 88px;
            height: 88px;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(0, 188, 212, 0.25);
            object-fit: cover;
        }

        .loader-icon {
            width: 96px;
            height: 96px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 188, 212, 0.3);
            animation: pulseIcon 1.5s ease-in-out infinite;
        }

        @keyframes pulseIcon {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.92; }
        }

        .add-form {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .add-form input {
            flex: 1;
            padding: 0.85rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
        }

        .add-form input:focus {
            border-color: #00bcd4;
        }

        .btn-save {
            padding: 0.85rem 2rem;
            border: none;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            background: linear-gradient(90deg, #00bcd4, #7c4dff);
        }

        .btn-save:hover {
            opacity: 0.92;
        }

        .btn-save:disabled {
            opacity: 0.75;
            cursor: not-allowed;
        }

        .btn-save .btn-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        .btn-save.loading .btn-text { display: none; }
        .btn-save.loading .btn-spinner { display: inline-block; }

        .btn-cancel:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Page loader */
        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.25rem;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 50%, #f0fdfa 100%);
            transition: opacity 0.45s ease, visibility 0.45s ease;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-ring {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, transparent 0%, #00bcd4 30%, #7c4dff 70%, transparent 100%);
            animation: spin 1s linear infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader-ring::after {
            content: '';
            width: 42px;
            height: 42px;
            background: #f8fafc;
            border-radius: 50%;
        }

        .loader-dots {
            display: flex;
            gap: 6px;
        }

        .loader-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(90deg, #00bcd4, #7c4dff);
            animation: bounce 1.2s ease-in-out infinite;
        }

        .loader-dots span:nth-child(2) { animation-delay: 0.15s; }
        .loader-dots span:nth-child(3) { animation-delay: 0.3s; }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0.6); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }

        /* Page content fade-in */
        .page-content {
            animation: fadeUp 0.5s ease 0.1s both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Action button loading */
        .action-btn.loading {
            opacity: 0.5;
            pointer-events: none;
        }

        .action-btn.loading svg {
            animation: spin 0.8s linear infinite;
        }

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .stat-done { color: #00bcd4; }
        .stat-progress { color: #7c4dff; }

        .task-table {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .task-header {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            padding: 0.85rem 1.25rem;
            background: #fafafa;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
        }

        .task-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #eee;
        }

        .task-row:last-child { border-bottom: none; }

        .task-row.done .task-note {
            text-decoration: line-through;
            color: #999;
        }

        .task-note {
            font-size: 0.95rem;
            word-break: break-word;
        }

        .task-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: none;
            background: none;
            cursor: pointer;
            padding: 0;
            text-decoration: none;
        }

        .action-btn svg {
            width: 22px;
            height: 22px;
        }

        .action-delete svg { stroke: #e53935; fill: none; stroke-width: 2; }
        .action-edit svg { stroke: #fbc02d; fill: none; stroke-width: 2; }
        .action-done svg { stroke: #43a047; fill: none; stroke-width: 2; }

        .action-done.done svg {
            fill: #43a047;
            stroke: #43a047;
        }

        .empty-state {
            padding: 2.5rem;
            text-align: center;
            color: #888;
            font-size: 0.95rem;
        }

        .field-error {
            color: #e53935;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .edit-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 0.4rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-cancel {
            padding: 0.75rem 1.25rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fff;
            font-family: inherit;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            color: #555;
        }

        @media (max-width: 520px) {
            .add-form { flex-direction: column; }
            .page-title { font-size: 1.75rem; }
        }
    </style>
</head>
<body>
    <div class="page-loader" id="pageLoader" aria-hidden="true">
        <img src="{{ asset('icon.png') }}" alt="PIC-DO" class="loader-icon">
        <div class="loader-ring"></div>
        <div class="loader-dots">
            <span></span><span></span><span></span>
        </div>
    </div>

    <div class="container page-content">
        @yield('content')
    </div>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('pageLoader');
            if (loader) {
                loader.classList.add('hidden');
                setTimeout(() => loader.remove(), 500);
            }
        });

        function setButtonLoading(btn, loading) {
            if (!btn) return;
            btn.disabled = loading;
            btn.classList.toggle('loading', loading);
        }

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (e.defaultPrevented) return;
                if (form.dataset.noLoader !== undefined) return;

                const btn = form.querySelector('.btn-save, .btn-cancel[type="submit"], button[type="submit"]');
                if (btn) setButtonLoading(btn, true);

                form.querySelectorAll('.action-btn').forEach(b => b.classList.add('loading'));
            });
        });
    </script>
</body>
</html>
