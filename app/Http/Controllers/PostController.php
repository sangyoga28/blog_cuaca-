<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a single post with comments
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with(['user', 'category', 'comments' => function ($query) {
                $query->where('approved', true)->latest();
            }])
            ->firstOrFail();

        // Get related posts from same category
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('post.show', compact('post', 'relatedPosts'));
    }

    /**
     * Store a new comment on a post
     */
    public function comment(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'content' => 'required|string|min:5|max:1000',
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'approved' => true, // Set to false for moderation if needed
        ]);

        return redirect()->route('post.show', $slug)
            ->with('success', 'Komentar Anda berhasil ditambahkan!');
    }
}
