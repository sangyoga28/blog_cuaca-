@extends('layouts.app')

@section('title', 'Dashboard Admin - Blog Cuaca')
@section('page-title')
    <h1>Dashboard Admin</h1>
    <p>Kelola pengguna, artikel, dan kategori</p>
@endsection

@section('sidebar-menu')
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link active">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/></svg>
                Dashboard
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.users') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                Pengguna
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.posts') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9 4.804C9 4.393 9.448 4 10 4s1 .393 1 .804v4.392h4.392c.411 0 .804.448.804 1 0 .552-.393 1-.804 1H11v4.392c0 .411-.448.804-1 .804s-1-.393-1-.804v-4.392H4.608c-.411 0-.804-.448-.804-1 0-.552.393-1 .804-1h4.392V4.804z"/></svg>
                Artikel
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.categories') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/></svg>
                Kategori
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Stats -->
    <div class="card-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Pengguna</h3>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Artikel</h3>
                <div class="stat-value">{{ $stats['total_posts'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path d="M9 4.804C9 4.393 9.448 4 10 4s1 .393 1 .804v4.392h4.392c.411 0 .804.448.804 1 0 .552-.393 1-.804 1H11v4.392c0 .411-.448.804-1 .804s-1-.393-1-.804v-4.392H4.608c-.411 0-.804-.448-.804-1 0-.552.393-1 .804-1h4.392V4.804z"/></svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Dipublikasikan</h3>
                <div class="stat-value">{{ $stats['published_posts'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Kategori</h3>
                <div class="stat-value">{{ $stats['total_categories'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/></svg>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 20px; margin-bottom: 20px;">
        <h3 style="margin-top: 0; color: var(--text-primary);">Artikel Terbaru</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_posts as $post)
                        <tr>
                            <td>{{ Illuminate\Support\Str::limit($post->title, 40) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <span style="font-size: 12px; padding: 4px 8px; border-radius: var(--radius-sm); background: {{ $post->status === 'published' ? 'rgba(34, 197, 94, 0.2); color: #22C55E' : ($post->status === 'draft' ? 'rgba(250, 204, 21, 0.2); color: #FACC15' : 'rgba(107, 114, 128, 0.2); color: #6B7280') }};">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn-sm btn-primary" style="text-decoration: none;">Edit</a>
                                    <form method="POST" action="{{ route('admin.posts.delete', $post->id) }}" style="display: inline;" onsubmit="return confirm('Yakin?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-muted);">Belum ada artikel</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Users -->
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 20px;">
        <h3 style="margin-top: 0; color: var(--text-primary);">Pengguna Terbaru</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span style="font-size: 12px; padding: 4px 8px; border-radius: var(--radius-sm); background: rgba(79, 124, 255, 0.2); color: var(--primary);">{{ ucfirst($user->role) }}</span></td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted);">Belum ada pengguna</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
