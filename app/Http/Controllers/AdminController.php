<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'total_categories' => Category::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
        ];

        $recent_posts = Post::latest()->limit(10)->get();
        $recent_users = User::latest()->limit(10)->get();

        return view('admin.dashboard', compact('stats', 'recent_posts', 'recent_users'));
    }

    /**
     * Manage Users
     */
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,penulis,pengunjung',
        ]);

        $user->update($validated);
        return redirect('/admin/users')->with('success', 'User berhasil diupdate!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/users')->with('success', 'User berhasil dihapus!');
    }

    /**
     * Manage Categories
     */
    public function categories()
    {
        $categories = Category::paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);
        return redirect('/admin/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return redirect('/admin/categories')->with('success', 'Kategori berhasil diupdate!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/admin/categories')->with('success', 'Kategori berhasil dihapus!');
    }

    /**
     * Manage Posts
     */
    public function posts()
    {
        $posts = Post::paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
        ]);

        $post->update($validated);
        return redirect('/admin/posts')->with('success', 'Artikel berhasil diupdate!');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/admin/posts')->with('success', 'Artikel berhasil dihapus!');
    }
}
