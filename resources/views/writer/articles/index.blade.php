@extends('layouts.app')

@section('title', 'Artikel Saya - Blog Cuaca')

@section('page-title')
    <h1>Artikel Saya</h1>
    <p>Kelola semua artikel yang Anda tulis</p>
@endsection

@section('sidebar-menu')
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('writer.dashboard') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/></svg>
                Dashboard
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('writer.articles') }}" class="sidebar-menu-link active">
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
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; color: var(--text-primary);">Daftar Artikel</h3>
            <a href="{{ route('writer.create') }}" class="btn-sm btn-primary" style="text-decoration: none;">+ Buat Artikel Baru</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Komentar</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>
                                @if($article->image_url)
                                    <div style="width: 60px; height: 40px; border-radius: 4px; overflow: hidden; background: #1a2a4e;">
                                        <img src="{{ $article->image_url }}" alt="cover" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @else
                                    <div style="width: 60px; height: 40px; border-radius: 4px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-size: 10px; color: var(--text-muted);">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <span style="font-weight: 500;">{{ Illuminate\Support\Str::limit($article->title, 40) }}</span>
                                    <br>
                                    <small style="color: var(--text-muted);">{{ $article->slug }}</small>
                                </div>
                            </td>
                            <td>{{ $article->category->name ?? 'Tidak ada' }}</td>
                            <td>
                                <span style="font-size: 12px; padding: 4px 8px; border-radius: var(--radius-sm); background: {{ $article->status === 'published' ? 'rgba(34, 197, 94, 0.2); color: #22C55E' : ($article->status === 'draft' ? 'rgba(250, 204, 21, 0.2); color: #FACC15' : 'rgba(107, 114, 128, 0.2); color: #6B7280') }};">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>{{ $article->comments->count() ?? 0 }}</td>
                            <td>{{ $article->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('writer.edit', $article->id) }}" class="btn-sm btn-primary" style="text-decoration: none;">Edit</a>
                                    <form method="POST" action="{{ route('writer.delete', $article->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: var(--text-muted);">Anda belum menulis artikel apapun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
            <div style="margin-top: 20px;">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
