<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My To Do List')</title>
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
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
