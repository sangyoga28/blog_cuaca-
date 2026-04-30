@extends('layouts.app')

@section('title', 'Edit Artikel - Blog Cuaca')

@section('page-title')
    <h1>Edit Artikel</h1>
    <p>Perbarui konten atau publikasikan artikel Anda</p>
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
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 24px;">
        <form method="POST" action="{{ route('writer.update', $post->id) }}" enctype="multipart/form-data">
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
                    <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Status Publikasi</label>
                    <select name="status" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); appearance: none;" required>
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }} style="background: #0F1729; color: white;">Draft</option>
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }} style="background: #0F1729; color: white;">Published</option>
                    </select>
                    @error('status') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Gambar Cover Baru (Opsional)</label>
                @if($post->image_url)
                    <div style="margin-bottom: 12px;">
                        <img src="{{ $post->image_url }}" alt="Cover Saat Ini" style="max-width: 200px; border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.1);">
                        <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Cover saat ini</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="input-field" style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary);">
                <small style="color: var(--text-muted);">Biarkan kosong jika tidak ingin mengubah gambar cover.</small>
                @error('image') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; text-transform: uppercase;">Konten Artikel</label>
                <textarea name="content" rows="15" class="input-field" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); font-family: inherit;" required>{{ old('content', $post->content) }}</textarea>
                @error('content') <span style="color: #EF4444; font-size: 12px; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn-sm btn-primary" style="padding: 12px 24px; font-size: 14px;">Simpan Perubahan</button>
                <a href="{{ route('writer.articles') }}" class="btn-sm btn-secondary" style="padding: 12px 24px; font-size: 14px; text-decoration: none; display: inline-block;">Batal</a>
            </div>
        </form>
    </div>
@endsection
