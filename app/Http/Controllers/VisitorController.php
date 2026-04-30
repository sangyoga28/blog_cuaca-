<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class VisitorController extends Controller
{

    /**
     * Search articles
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $categories = Category::all();

        $posts = Post::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhereHas('user', function($q2) use ($query) {
                      $q2->where('name', 'like', "%{$query}%");
                  });
            })
            ->latest()
            ->paginate(12);

        $page_title = 'Hasil Pencarian: ' . $query;

        return view('visitor.dashboard', compact('posts', 'query', 'categories', 'page_title'));
    }

    /**
     * Filter by category
     */
    public function category($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();

        $posts = Post::where('status', 'published')
            ->where('category_id', $id)
            ->latest()
            ->paginate(12);

        $page_title = 'Kategori: ' . $category->name;

        return view('visitor.dashboard', compact('posts', 'category', 'categories', 'page_title'));
    }

    /**
     * View single article
     */
    public function article($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $related_posts = Post::where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(4)
            ->get();

        $comments = $post->comments()->paginate(10);

        return view('visitor.article', compact('post', 'related_posts', 'comments'));
    }

    /**
     * Add comment to article
     */
    public function addComment(Request $request, $postId)
    {
        $post = Post::where('id', $postId)
            ->where('status', 'published')
            ->firstOrFail();

        $validated = $request->validate([
            'content' => 'required|string|min:5|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Komentar Anda berhasil ditambahkan!');
    }

    /**
     * User profile
     */
    public function profile($username)
    {
        $user = \App\Models\User::where('name', $username)->firstOrFail();
        $articles = $user->posts()
            ->where('status', 'published')
            ->paginate(12);

        return view('visitor.profile', compact('user', 'articles'));
    }

    /**
     * Dashboard for visitors (shows latest articles)
     */
    public function dashboard()
    {
        $categories = Category::all();
        $posts = Post::where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('visitor.dashboard', compact('posts', 'categories'));
    }
}
