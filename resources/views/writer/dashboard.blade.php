@extends('layouts.app')

@section('title', 'Dashboard Penulis - Blog Cuaca')
@section('page-title')
    <h1>Dashboard Penulis</h1>
    <p>Kelola artikel dan komentar Anda</p>
@endsection

@section('sidebar-menu')
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('writer.dashboard') }}" class="sidebar-menu-link active">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/></svg>
                Dashboard
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('writer.articles') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9 4.804C9 4.393 9.448 4 10 4s1 .393 1 .804v4.392h4.392c.411 0 .804.448.804 1 0 .552-.393 1-.804 1H11v4.392c0 .411-.448.804-1 .804s-1-.393-1-.804v-4.392H4.608c-.411 0-.804-.448-.804-1 0-.552.393-1 .804-1h4.392V4.804z"/></svg>
                Artikel
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('writer.create') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                Buat Artikel
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('writer.comments') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/></svg>
                Komentar
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Stats -->
    <div class="card-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Artikel</h3>
                <div class="stat-value">{{ $stats['total_articles'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path d="M9 4.804C9 4.393 9.448 4 10 4s1 .393 1 .804v4.392h4.392c.411 0 .804.448.804 1 0 .552-.393 1-.804 1H11v4.392c0 .411-.448.804-1 .804s-1-.393-1-.804v-4.392H4.608c-.411 0-.804-.448-.804-1 0-.552.393-1 .804-1h4.392V4.804z"/></svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Dipublikasikan</h3>
                <div class="stat-value">{{ $stats['published_articles'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Draft</h3>
                <div class="stat-value">{{ $stats['draft_articles'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Komentar</h3>
                <div class="stat-value">{{ $stats['total_comments'] }}</div>
            </div>
            <div class="stat-icon">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 24px; height: 24px;"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/></svg>
            </div>
        </div>
    </div>

    <!-- Recent Articles -->
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 20px; margin-bottom: 20px;">
        <h3 style="margin-top: 0; color: var(--text-primary);">Artikel Terbaru</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_articles as $article)
                        <tr>
                            <td>{{ Illuminate\Support\Str::limit($article->title, 40) }}</td>
                            <td>{{ $article->category->name ?? '-' }}</td>
                            <td>
                                <span style="font-size: 12px; padding: 4px 8px; border-radius: var(--radius-sm); background: {{ $article->status === 'published' ? 'rgba(34, 197, 94, 0.2); color: #22C55E' : ($article->status === 'draft' ? 'rgba(250, 204, 21, 0.2); color: #FACC15' : 'rgba(107, 114, 128, 0.2); color: #6B7280') }};">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>{{ $article->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('writer.edit', $article->id) }}" class="btn-sm btn-primary" style="text-decoration: none;">Edit</a>
                                    <form method="POST" action="{{ route('writer.delete', $article->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
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

    <!-- Recent Comments -->
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 20px;">
        <h3 style="margin-top: 0; color: var(--text-primary);">Komentar Terbaru</h3>
        @forelse($recent_comments as $comment)
            <div style="padding: 12px; background: rgba(255,255,255,0.05); border-radius: var(--radius-md); margin-bottom: 12px;">
                <p style="margin: 0 0 4px; color: var(--text-primary); font-size: 13px; font-weight: 500;">{{ $comment->user->name }} pada <strong>{{ $comment->post->title }}</strong></p>
                <p style="margin: 0; color: var(--text-secondary); font-size: 13px;">{{ Illuminate\Support\Str::limit($comment->content, 80) }}</p>
            </div>
        @empty
            <p style="text-align: center; color: var(--text-muted);">Belum ada komentar</p>
        @endforelse
    </div>
@endsection
