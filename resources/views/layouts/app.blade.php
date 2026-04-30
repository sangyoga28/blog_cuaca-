<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blog Cuaca')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        /* ===== Main Layout ===== */
        body.app-layout {
            background: linear-gradient(135deg, #0F1729 0%, #1a2a4e 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .app-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            background: rgba(15, 23, 42, 0.95);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            overflow-y: auto;
            z-index: 1000;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            overflow-y: auto;
        }

        /* ===== Sidebar Branding ===== */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4F7CFF, #FF8C42);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand-text h3 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .sidebar-brand-text span {
            font-size: 11px;
            color: var(--text-secondary);
        }

        /* ===== Sidebar Menu ===== */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu-item {
            margin: 8px 0;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all var(--transition-fast);
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-menu-link:hover {
            color: var(--primary);
            background: rgba(79, 124, 255, 0.1);
        }

        .sidebar-menu-link.active {
            color: var(--primary);
            background: rgba(79, 124, 255, 0.15);
            border-left: 3px solid var(--primary);
            padding-left: 11px;
        }

        .sidebar-menu-link svg {
            width: 20px;
            height: 20px;
        }

        /* ===== Sidebar User Info ===== */
        .sidebar-user {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all var(--transition-fast);
            margin-bottom: 10px;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F7CFF, #FF8C42);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info h4 {
            margin: 0;
            font-size: 13px;
            color: var(--text-primary);
            font-weight: 600;
        }

        .user-info p {
            margin: 0;
            font-size: 11px;
            color: var(--text-secondary);
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #EF4444;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all var(--transition-fast);
            border: none;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* ===== Top Bar ===== */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            background: rgba(15, 23, 42, 0.7);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        .top-bar-title h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .top-bar-title p {
            margin: 4px 0 0;
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* ===== Alert Box ===== */
        .alert {
            padding: 14px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22C55E;
        }

        .alert-error {
            background: var(--error-bg);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #EF4444;
        }

        .alert-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* ===== Card Grid ===== */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .stat-info h3 {
            margin: 0 0 8px;
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(79, 124, 255, 0.1);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        /* ===== Table ===== */
        .table-container {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(79, 124, 255, 0.1);
        }

        th {
            padding: 14px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
            color: var(--text-primary);
        }

        tbody tr:hover {
            background: rgba(79, 124, 255, 0.05);
        }

        /* ===== Action Buttons ===== */
        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            transition: all var(--transition-fast);
            font-weight: 500;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #EF4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-secondary);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-primary);
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .app-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body class="app-layout">
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">BC</div>
                <div class="sidebar-brand-text">
                    <h3>Blog Cuaca</h3>
                    <span>Dashboard</span>
                </div>
            </div>

            <nav>
                @yield('sidebar-menu')

                @if(request()->is('visitor/*') || request()->is('search') || request()->is('category/*') || request()->is('article/*'))
                    <div class="sidebar-comments" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                        <h4 style="color: var(--text-primary); font-size: 13px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <svg style="width: 16px; height: 16px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Komentar Terbaru
                        </h4>
                        @php
                            $latestComments = \App\Models\Comment::with(['user', 'post'])->latest()->take(3)->get();
                        @endphp
                        @forelse($latestComments as $comment)
                            <div style="margin-bottom: 10px; background: rgba(255,255,255,0.03); padding: 10px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.05);">
                                <p style="margin: 0; font-size: 11px; color: var(--text-secondary);">
                                    <strong>{{ $comment->user->name }}</strong> di 
                                    <a href="{{ route('article', $comment->post->slug) }}" style="color: var(--primary); text-decoration: none;">{{ \Illuminate\Support\Str::limit($comment->post->title, 20) }}</a>
                                </p>
                                <p style="margin: 4px 0 0; font-size: 12px; color: var(--text-primary); line-height: 1.4;">"{{ \Illuminate\Support\Str::limit($comment->content, 40) }}"</p>
                            </div>
                        @empty
                            <p style="font-size: 12px; color: var(--text-muted); text-align: center;">Belum ada komentar.</p>
                        @endforelse
                    </div>
                @endif
            </nav>

            <div class="sidebar-user">
                @auth
                <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div class="user-info">
                        <h4>{{ auth()->user()->name }}</h4>
                        <p>{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
                @else
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <a href="{{ route('login') }}" class="btn-sm btn-primary" style="text-align: center; text-decoration: none;">Login</a>
                    <a href="{{ route('register') }}" class="btn-sm btn-secondary" style="text-align: center; text-decoration: none;">Register</a>
                </div>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="top-bar-title">
                    @yield('page-title')
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success">
                    <svg class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <svg class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    @yield('extra-js')
</body>
</html>
