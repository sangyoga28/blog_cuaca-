@extends('layouts.app')

@section('title', 'Home - Blog Cuaca')
@section('page-title')
    <h1>{{ $page_title ?? 'Dashboard Pengunjung' }}</h1>
    <p>{{ $page_subtitle ?? 'Temukan artikel cuaca terbaru dan terpercaya' }}</p>
@endsection

@section('sidebar-menu')
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('visitor.dashboard') }}" class="sidebar-menu-link active">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Beranda
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <!-- Search & Filter -->
    <div style="display: flex; gap: 12px; margin-bottom: 20px;">
        <form action="{{ route('search') }}" method="GET" style="flex: 1;">
            <div style="display: flex; gap: 8px;">
                <input 
                    type="text" 
                    name="q" 
                    class="input-field" 
                    placeholder="Cari artikel..." 
                    value="{{ request('q') }}"
                    style="flex: 1; padding: 10px 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary);"
                >
                <button type="submit" class="btn-sm btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Categories -->
    @if($categories->count())
        <div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
            <a href="{{ route('visitor.dashboard') }}" class="btn-sm btn-secondary" style="text-decoration: none;">Semua</a>
            @foreach($categories as $cat)
                <a href="{{ route('category', $cat->id) }}" class="btn-sm btn-secondary" style="text-decoration: none;">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    @endif

    <!-- Articles Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; margin-bottom: 20px;">
        @forelse($posts as $post)
            <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); overflow: hidden; transition: all var(--transition-fast); cursor: pointer;">
                @if($post->image_url)
                    <div style="height: 180px; overflow: hidden; background: rgba(79, 124, 255, 0.1);">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @else
                    <div style="height: 180px; background: linear-gradient(135deg, rgba(79, 124, 255, 0.2), rgba(255, 140, 66, 0.2)); display: flex; align-items: center; justify-content: center; color: var(--text-secondary);">
                        Tidak ada gambar
                    </div>
                @endif

                <div style="padding: 16px;">
                    <div style="display: flex; gap: 8px; margin-bottom: 8px;">
                        <span style="font-size: 11px; background: rgba(79, 124, 255, 0.2); color: var(--primary); padding: 4px 8px; border-radius: var(--radius-sm);">
                            {{ $post->category->name ?? 'Umum' }}
                        </span>
                    </div>

                    <h3 style="margin: 0 0 8px; font-size: 16px; color: var(--text-primary); font-weight: 600;">
                        <a href="{{ route('article', $post->slug) }}" style="color: inherit; text-decoration: none;">
                            {{ Illuminate\Support\Str::limit($post->title, 50) }}
                        </a>
                    </h3>

                    <p style="margin: 0 0 12px; font-size: 13px; color: var(--text-secondary); line-height: 1.5;">
                        {{ Illuminate\Support\Str::limit(strip_tags($post->content), 80) }}
                    </p>

                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: var(--text-muted);">
                        <span>Oleh: {{ $post->user->name }}</span>
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; color: var(--text-secondary);">
                <svg style="width: 48px; height: 48px; margin-bottom: 16px; opacity: 0.5;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 6v6m0 0v6"></path>
                </svg>
                <p>Belum ada artikel yang tersedia</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div style="display: flex; gap: 8px; justify-content: center; margin-top: 20px;">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
