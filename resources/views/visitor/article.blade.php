@extends('layouts.app')

@section('title', 'Article - Blog Cuaca')
@section('page-title')
    <h1>{{ $post->title }}</h1>
    <p>Ditulis oleh {{ $post->user->name }} • {{ $post->created_at->format('d M Y') }}</p>
@endsection

@section('sidebar-menu')
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('dashboard') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                Dashboard
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div style="max-width: 900px; margin: 0 auto;">
        <!-- Article Header -->
        @if($post->image_url)
            <div style="width: 100%; height: 300px; margin-bottom: 20px; border-radius: var(--radius-lg); overflow: hidden;">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        @endif

        <!-- Article Metadata -->
        <div style="display: flex; gap: 16px; margin-bottom: 20px; padding: 16px; background: rgba(79, 124, 255, 0.1); border-radius: var(--radius-md); align-items: center;">
            <div style="flex: 1;">
                <span style="display: inline-block; font-size: 12px; background: var(--primary); color: white; padding: 4px 10px; border-radius: var(--radius-sm); margin-bottom: 8px;">
                    {{ $post->category->name ?? 'Umum' }}
                </span>
                <div style="color: var(--text-secondary); font-size: 13px;">
                    <span>Oleh <strong>{{ $post->user->name }}</strong></span><br>
                    <span>{{ $post->created_at->format('d F Y \p\u\k\u\l H:i') }}</span>
                </div>
            </div>
            <div style="text-align: right; color: var(--text-secondary); font-size: 13px;">
                <p style="margin: 0;">{{ count($post->comments) }} Komentar</p>
            </div>
        </div>

        <!-- Article Content -->
        <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 24px; margin-bottom: 20px; line-height: 1.8; color: var(--text-primary);">
            {!! nl2br(e($post->content)) !!}
        </div>

        <!-- Comments Section -->
        <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 24px;">
            <h3 style="margin-top: 0; color: var(--text-primary);">Komentar ({{ count($post->comments) }})</h3>

            @auth
                <form method="POST" action="{{ route('visitor.comment', $post->id) }}" style="margin-bottom: 24px;">
                    @csrf
                    <textarea name="content" rows="4" class="input-field" placeholder="Tulis komentar Anda..." style="width: 100%; padding: 10px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary);" required></textarea>
                    <button type="submit" class="btn-sm btn-primary" style="margin-top: 8px;">Kirim Komentar</button>
                </form>
            @else
                <div style="padding: 16px; background: rgba(79, 124, 255, 0.1); border-radius: var(--radius-md); margin-bottom: 20px; color: var(--text-secondary);">
                    <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 500;">Masuk</a> untuk menambahkan komentar
                </div>
            @endauth

            <!-- Comments List -->
            <div style="space-y: 16px;">
                @forelse($comments as $comment)
                    <div style="padding: 16px; background: rgba(255,255,255,0.05); border-radius: var(--radius-md); margin-bottom: 12px;">
                        <div style="display: flex; gap: 12px; margin-bottom: 8px;">
                            <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #4F7CFF, #FF8C42); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                            <div style="flex: 1;">
                                <h4 style="margin: 0; color: var(--text-primary); font-size: 14px;">{{ $comment->user->name }}</h4>
                                <p style="margin: 0; color: var(--text-muted); font-size: 12px;">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p style="text-align: center; color: var(--text-muted);">Belum ada komentar. Jadilah yang pertama!</p>
                @endforelse
            </div>

            @if($comments->hasPages())
                <div style="margin-top: 16px;">
                    {{ $comments->links() }}
                </div>
            @endif
        </div>

        <!-- Related Articles -->
        @if($related_posts->count())
            <div style="margin-top: 40px;">
                <h3 style="color: var(--text-primary); margin-bottom: 16px;">Artikel Terkait</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px;">
                    @foreach($related_posts as $related)
                        <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 16px;">
                            <h4 style="margin: 0 0 8px; color: var(--text-primary); font-size: 14px;">
                                <a href="{{ route('article', $related->slug) }}" style="color: inherit; text-decoration: none;">{{ Illuminate\Support\Str::limit($related->title, 40) }}</a>
                            </h4>
                            <p style="margin: 0; font-size: 12px; color: var(--text-secondary);">{{ $related->created_at->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
