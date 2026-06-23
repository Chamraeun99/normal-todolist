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
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0e17;
            --surface: rgba(15, 23, 42, 0.75);
            --surface-solid: #111827;
            --border: rgba(56, 189, 248, 0.15);
            --cyan: #22d3ee;
            --purple: #a78bfa;
            --pink: #f472b6;
            --green: #34d399;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --glow: 0 0 40px rgba(34, 211, 238, 0.15);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated tech background */
        .tech-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .tech-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(34, 211, 238, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(34, 211, 238, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { transform: perspective(500px) rotateX(60deg) translateY(0); }
            100% { transform: perspective(500px) rotateX(60deg) translateY(48px); }
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: orbFloat 8s ease-in-out infinite;
        }

        .orb-1 { width: 400px; height: 400px; background: #0891b2; top: -100px; left: -100px; }
        .orb-2 { width: 350px; height: 350px; background: #7c3aed; bottom: -80px; right: -80px; animation-delay: -3s; }
        .orb-3 { width: 250px; height: 250px; background: #db2777; top: 40%; left: 50%; animation-delay: -5s; }

        @keyframes orbFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -20px) scale(1.1); }
        }

        .float-icon {
            position: absolute;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: rgba(34, 211, 238, 0.25);
            animation: floatDrift 12s ease-in-out infinite;
            white-space: nowrap;
        }

        .float-icon:nth-child(1) { top: 12%; left: 8%; animation-delay: 0s; }
        .float-icon:nth-child(2) { top: 25%; right: 10%; animation-delay: -2s; color: rgba(167, 139, 250, 0.3); }
        .float-icon:nth-child(3) { bottom: 30%; left: 5%; animation-delay: -4s; }
        .float-icon:nth-child(4) { bottom: 15%; right: 8%; animation-delay: -6s; color: rgba(52, 211, 153, 0.25); }
        .float-icon:nth-child(5) { top: 55%; left: 15%; animation-delay: -8s; font-size: 1.5rem; }
        .float-icon:nth-child(6) { top: 18%; left: 45%; animation-delay: -1s; font-size: 1.8rem; }

        @keyframes floatDrift {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-15px) rotate(5deg); opacity: 0.6; }
        }

        .scanline {
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.03) 2px,
                rgba(0, 0, 0, 0.03) 4px
            );
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 720px;
            margin: 0 auto;
            padding: 2rem 1.25rem 3rem;
        }

        .page-content { animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) both; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.5s ease both;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--green);
            background: rgba(52, 211, 153, 0.1);
            border: 1px solid rgba(52, 211, 153, 0.25);
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: var(--green);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.5); }
            50% { opacity: 0.7; box-shadow: 0 0 0 6px rgba(52, 211, 153, 0); }
        }

        .app-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            animation: fadeUp 0.6s ease 0.1s both;
        }

        .app-icon-wrap {
            position: relative;
            animation: iconFloat 4s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .app-icon-wrap::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            opacity: 0.35;
            filter: blur(16px);
            animation: glowPulse 3s ease infinite;
        }

        @keyframes glowPulse {
            0%, 100% { opacity: 0.25; transform: scale(1); }
            50% { opacity: 0.45; transform: scale(1.05); }
        }

        .app-icon {
            position: relative;
            width: 96px;
            height: 96px;
            border-radius: 20px;
            border: 2px solid rgba(34, 211, 238, 0.3);
            object-fit: cover;
            box-shadow: var(--glow);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-align: center;
            background: linear-gradient(135deg, var(--cyan), var(--purple), var(--pink));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 4s linear infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        .page-subtitle {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: var(--muted);
            letter-spacing: 0.05em;
        }

        .glass-card {
            background: var(--surface);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--glow);
            animation: fadeUp 0.6s ease 0.2s both;
        }

        .add-form {
            display: flex;
            gap: 0.75rem;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .input-wrap {
            flex: 1;
            position: relative;
        }

        .input-wrap::before {
            content: '>';
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'JetBrains Mono', monospace;
            color: var(--cyan);
            font-weight: 600;
            pointer-events: none;
        }

        .add-form input,
        .form-group input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2rem;
            background: rgba(0, 0, 0, 0.35);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            color: var(--text);
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .form-group input { padding-left: 1rem; }

        .add-form input:focus,
        .form-group input:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .add-form input::placeholder { color: var(--muted); }

        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.9rem 1.75rem;
            border: none;
            border-radius: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            font-weight: 600;
            color: #0a0e17;
            cursor: pointer;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-save::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(34, 211, 238, 0.35);
        }

        .btn-save:hover::before { transform: translateX(100%); }

        .btn-save:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

        .btn-save .btn-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(10, 14, 23, 0.3);
            border-top-color: #0a0e17;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        .btn-save.loading .btn-text { display: none; }
        .btn-save.loading .btn-spinner { display: inline-block; }

        .btn-cancel {
            padding: 0.65rem 1.1rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.3);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: var(--muted);
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-cancel:hover {
            border-color: var(--purple);
            color: var(--text);
        }

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .stat-box {
            padding: 1.1rem 1.25rem;
            border-radius: 14px;
            background: var(--surface);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            animation: fadeUp 0.5s ease both;
            transition: transform 0.25s, border-color 0.25s;
        }

        .stat-box:nth-child(1) { animation-delay: 0.25s; }
        .stat-box:nth-child(2) { animation-delay: 0.35s; }

        .stat-box:hover {
            transform: translateY(-3px);
            border-color: rgba(34, 211, 238, 0.35);
        }

        .stat-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.35rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .stat-done .stat-value { color: var(--cyan); }
        .stat-progress .stat-value { color: var(--purple); }

        .task-table {
            overflow: hidden;
            border-radius: 16px;
        }

        .task-header {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            padding: 0.9rem 1.25rem;
            background: rgba(34, 211, 238, 0.06);
            border-bottom: 1px solid var(--border);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--cyan);
        }

        .task-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            animation: slideIn 0.4s ease both;
            transition: background 0.2s;
        }

        .task-row:hover { background: rgba(34, 211, 238, 0.04); }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-12px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .task-row:last-child { border-bottom: none; }

        .task-row.done { opacity: 0.55; }

        .task-row.done .task-note {
            text-decoration: line-through;
            color: var(--muted);
        }

        .task-note {
            font-size: 0.95rem;
            word-break: break-word;
        }

        .task-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border: 1px solid transparent;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.25);
            cursor: pointer;
            padding: 0;
            text-decoration: none;
            transition: transform 0.2s, border-color 0.2s, background 0.2s;
        }

        .action-btn:hover { transform: scale(1.1); }

        .action-btn svg { width: 18px; height: 18px; }

        .action-delete:hover { border-color: rgba(248, 113, 113, 0.4); background: rgba(248, 113, 113, 0.1); }
        .action-delete svg { stroke: #f87171; fill: none; stroke-width: 2; }

        .action-edit:hover { border-color: rgba(251, 191, 36, 0.4); background: rgba(251, 191, 36, 0.1); }
        .action-edit svg { stroke: #fbbf24; fill: none; stroke-width: 2; }

        .action-done:hover { border-color: rgba(52, 211, 153, 0.4); background: rgba(52, 211, 153, 0.1); }
        .action-done svg { stroke: #34d399; fill: none; stroke-width: 2; }
        .action-done.done svg { fill: #34d399; stroke: #34d399; }

        .action-btn.loading { opacity: 0.5; pointer-events: none; }
        .action-btn.loading svg { animation: spin 0.8s linear infinite; }

        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
            color: var(--muted);
        }

        .empty-state .robot {
            font-size: 3rem;
            margin-bottom: 0.75rem;
            animation: iconFloat 3s ease infinite;
        }

        .empty-state p {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
        }

        .field-error {
            color: #f87171;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            margin: 0 1.25rem 1rem;
            padding: 0.65rem 1rem;
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.25);
            border-radius: 8px;
        }

        .edit-card {
            padding: 1.75rem;
            max-width: 420px;
            margin: 0 auto;
        }

        .form-group { margin-bottom: 1.25rem; }

        .form-group label {
            display: block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--cyan);
            margin-bottom: 0.5rem;
        }

        .form-actions { display: flex; gap: 0.75rem; }

        .login-terminal {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            color: var(--muted);
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            border-left: 3px solid var(--cyan);
        }

        .login-terminal span { color: var(--cyan); }

        /* Page loader */
        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            background: var(--bg);
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-icon {
            width: 88px;
            height: 88px;
            border-radius: 18px;
            border: 2px solid rgba(34, 211, 238, 0.4);
            animation: pulseIcon 1.5s ease infinite;
        }

        @keyframes pulseIcon {
            0%, 100% { transform: scale(1); box-shadow: 0 0 30px rgba(34, 211, 238, 0.2); }
            50% { transform: scale(1.05); box-shadow: 0 0 50px rgba(167, 139, 250, 0.35); }
        }

        .loader-code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: var(--muted);
            text-align: center;
            min-height: 1.2em;
        }

        .loader-code .cursor {
            display: inline-block;
            width: 8px;
            height: 1em;
            background: var(--cyan);
            margin-left: 2px;
            animation: blink 0.8s step-end infinite;
            vertical-align: text-bottom;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .loader-bar {
            width: 200px;
            height: 3px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 3px;
            overflow: hidden;
        }

        .loader-bar-fill {
            height: 100%;
            width: 40%;
            background: linear-gradient(90deg, var(--cyan), var(--purple));
            border-radius: 3px;
            animation: loadBar 1.2s ease-in-out infinite;
        }

        @keyframes loadBar {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(350%); }
        }

        .loader-robot {
            font-size: 2rem;
            animation: robotBounce 1s ease infinite;
        }

        @keyframes robotBounce {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 520px) {
            .add-form { flex-direction: column; }
            .page-title { font-size: 1.5rem; }
            .float-icon { display: none; }
        }
    </style>
</head>
<body>
    <div class="tech-bg" aria-hidden="true">
        <div class="tech-grid"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <span class="float-icon">&lt;code/&gt;</span>
        <span class="float-icon">{ todo.init() }</span>
        <span class="float-icon">01001001</span>
        <span class="float-icon">async await</span>
        <span class="float-icon">🤖</span>
        <span class="float-icon">⚡</span>
        <div class="scanline"></div>
    </div>

    <div class="page-loader" id="pageLoader">
        <div class="loader-robot">🤖</div>
        <img src="{{ asset('icon.png') }}" alt="" class="loader-icon">
        <div class="loader-code" id="loaderCode"><span class="cursor"></span></div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>

    <div class="container page-content">
        @yield('content')
    </div>

    <script>
        const codeLines = [
            '> boot PIC-DO v1.0...',
            '> loading modules...',
            '> connect database...',
            '> init task engine...',
            '> ready ✓'
        ];
        let lineIdx = 0;
        const loaderCode = document.getElementById('loaderCode');
        const typeInterval = setInterval(() => {
            if (lineIdx < codeLines.length && loaderCode) {
                loaderCode.innerHTML = codeLines[lineIdx] + '<span class="cursor"></span>';
                lineIdx++;
            }
        }, 400);

        window.addEventListener('load', () => {
            clearInterval(typeInterval);
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
                if (e.defaultPrevented || form.dataset.noLoader !== undefined) return;
                const btn = form.querySelector('.btn-save, .btn-cancel[type="submit"], button[type="submit"]');
                if (btn) setButtonLoading(btn, true);
                form.querySelectorAll('.action-btn').forEach(b => b.classList.add('loading'));
            });
        });

        document.querySelectorAll('.task-row').forEach((row, i) => {
            row.style.animationDelay = `${0.05 * i}s`;
        });
    </script>
</body>
</html>
