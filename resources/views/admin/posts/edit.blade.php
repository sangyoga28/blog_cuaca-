@extends('layouts.app')

@section('title', 'Edit Artikel - Blog Cuaca')

@section('page-title')
    <h1>Edit Artikel</h1>
    <p>Ubah status atau kategori artikel</p>
@endsection

@section('sidebar-menu')
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link">
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
            <a href="{{ route('admin.posts') }}" class="sidebar-menu-link active">
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
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 24px;">
        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="input-field" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary);" required>
                @error('title') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px; display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Kategori</label>
                    <select name="category_id" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); appearance: none;" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }} style="background: #0F1729; color: white;">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Status</label>
                    <select name="status" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); appearance: none;" required>
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }} style="background: #0F1729; color: white;">Draft</option>
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }} style="background: #0F1729; color: white;">Published</option>
                        <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }} style="background: #0F1729; color: white;">Archived</option>
                    </select>
                    @error('status') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Konten Artikel</label>
                <textarea name="content" rows="12" class="input-field" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary);" required>{{ old('content', $post->content) }}</textarea>
                @error('content') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn-sm btn-primary" style="padding: 10px 20px; font-size: 14px;">Simpan Perubahan</button>
                <a href="{{ route('admin.posts') }}" class="btn-sm btn-secondary" style="padding: 10px 20px; font-size: 14px; text-decoration: none; display: inline-block;">Batal</a>
            </div>
        </form>
    </div>
@endsection
