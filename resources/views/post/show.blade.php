<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $post->title }}">
    <title>{{ $post->title }} — Blog Cuaca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Merriweather', serif;
            background: #f8f9fa;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .nav-link:hover {
            color: #764ba2;
        }

        .article-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .article-header {
            margin-bottom: 3rem;
            text-align: center;
        }

        .article-category {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.3rem;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            color: #1a1a1a;
        }

        .article-meta {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            font-size: 0.95rem;
            color: #666;
            font-family: 'Inter', sans-serif;
            margin-bottom: 2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .article-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 0.8rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .article-content {
            background: white;
            padding: 2rem;
            border-radius: 0.8rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 2rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2 {
            font-size: 1.8rem;
            margin: 2rem 0 1rem 0;
            color: #667eea;
        }

        .article-content h3 {
            font-size: 1.4rem;
            margin: 1.5rem 0 1rem 0;
            color: #764ba2;
        }

        .article-content blockquote {
            border-left: 4px solid #667eea;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            color: #666;
            font-style: italic;
        }

        .article-content ul, .article-content ol {
            margin: 1.5rem 0 1.5rem 2rem;
        }

        .article-content li {
            margin-bottom: 0.8rem;
        }

        .related-posts {
            background: white;
            padding: 2rem;
            border-radius: 0.8rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .related-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .related-card {
            background: #f9f9f9;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .related-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .related-card a {
            text-decoration: none;
            color: inherit;
            display: block;
            padding: 1rem;
        }

        .related-card-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            color: #333;
            font-family: 'Inter', sans-serif;
        }

        .related-card-date {
            font-size: 0.85rem;
            color: #999;
            font-family: 'Inter', sans-serif;
        }

        .comments-section {
            background: white;
            padding: 2rem;
            border-radius: 0.8rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .comments-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .comment-form {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 0.5rem;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
            font-family: 'Inter', sans-serif;
        }

        .submit-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .comments-list {
            margin-top: 2rem;
        }

        .comment {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
        }

        .comment-author {
            font-weight: 700;
            color: #333;
            margin-bottom: 0.3rem;
            font-family: 'Inter', sans-serif;
        }

        .comment-date {
            font-size: 0.85rem;
            color: #999;
            margin-bottom: 0.8rem;
            font-family: 'Inter', sans-serif;
        }

        .comment-content {
            color: #555;
            line-height: 1.6;
            font-family: 'Inter', sans-serif;
        }

        .no-comments {
            text-align: center;
            padding: 2rem;
            color: #999;
            font-family: 'Inter', sans-serif;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 1.8rem;
            }

            .article-image {
                height: 250px;
            }

            .article-meta {
                gap: 1rem;
                justify-content: center;
                font-size: 0.85rem;
            }

            .article-content {
                padding: 1.5rem;
                font-size: 1rem;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">☁️ Blog Cuaca</a>
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}" class="nav-link">← Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Article Container -->
    <div class="article-container">
        <!-- Article Header -->
        <article class="article-header">
            @if ($post->category)
                <div class="article-category">{{ $post->category->name }}</div>
            @endif
            
            <h1 class="article-title">{{ $post->title }}</h1>

            <div class="article-meta">
                <div class="meta-item">
                    <div class="author-avatar">{{ substr($post->user->name, 0, 1) }}</div>
                    <span>{{ $post->user->name }}</span>
                </div>
                <div class="meta-item">📅 {{ $post->created_at->format('d F Y') }}</div>
                <div class="meta-item">⏱️ {{ ceil(str_word_count($post->content) / 200) }} menit baca</div>
            </div>

            @if ($post->image_url)
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="article-image">
            @endif
        </article>

        <!-- Article Content -->
        <div class="article-content">
            {!! nl2br(e($post->content)) !!}
        </div>

        <!-- Related Articles -->
        @if ($relatedPosts->count() > 0)
            <div class="related-posts">
                <h2 class="related-title">📚 Artikel Sejenis</h2>
                <div class="related-grid">
                    @foreach ($relatedPosts as $related)
                        <div class="related-card">
                            <a href="{{ route('post.show', $related->slug) }}">
                                <div class="related-card-title">{{ $related->title }}</div>
                                <div class="related-card-date">{{ $related->created_at->format('d M Y') }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Comments Section -->
        <div class="comments-section">
            <h2 class="comments-title">💬 Komentar ({{ $post->comments->count() }})</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Comment Form -->
            <div class="comment-form">
                <form action="{{ route('post.comment', $post->slug) }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Komentar Anda</label>
                        <textarea 
                            name="content" 
                            class="form-textarea" 
                            placeholder="Tulis komentar Anda di sini... (minimal 5 karakter)"
                            required
                            minlength="5"
                            maxlength="1000"
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <small style="color: #dc3545;">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn">Kirim Komentar</button>
                </form>
            </div>

            <!-- Comments List -->
            <div class="comments-list">
                @if ($post->comments->count() > 0)
                    @foreach ($post->comments as $comment)
                        <div class="comment">
                            <div class="comment-author">👤 {{ $comment->user->name }}</div>
                            <div class="comment-date">{{ $comment->created_at->format('d F Y H:i') }}</div>
                            <div class="comment-content">{{ $comment->content }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="no-comments">
                        <p>📭 Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
