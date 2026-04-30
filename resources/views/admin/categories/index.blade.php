@extends('layouts.app')

@section('title', 'Manajemen Kategori - Blog Cuaca')

@section('page-title')
    <h1>Manajemen Kategori</h1>
    <p>Kelola kategori artikel cuaca</p>
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
            <a href="{{ route('admin.posts') }}" class="sidebar-menu-link">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9 4.804C9 4.393 9.448 4 10 4s1 .393 1 .804v4.392h4.392c.411 0 .804.448.804 1 0 .552-.393 1-.804 1H11v4.392c0 .411-.448.804-1 .804s-1-.393-1-.804v-4.392H4.608c-.411 0-.804-.448-.804-1 0-.552.393-1 .804-1h4.392V4.804z"/></svg>
                Artikel
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.categories') }}" class="sidebar-menu-link active">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/></svg>
                Kategori
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: var(--radius-lg); padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; color: var(--text-primary);">Daftar Kategori</h3>
            <a href="{{ route('admin.categories.create') }}" class="btn-sm btn-primary" style="text-decoration: none;">+ Tambah Kategori</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th>Total Artikel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>#{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ Illuminate\Support\Str::limit($category->description, 50) }}</td>
                            <td>{{ $category->posts->count() ?? 0 }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-sm btn-primary" style="text-decoration: none;">Edit</a>
                                    <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua artikel dalam kategori ini mungkin terdampak.');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted);">Belum ada kategori terdaftar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div style="margin-top: 20px;">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
