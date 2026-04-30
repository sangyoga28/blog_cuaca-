<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostPublished;

class WriterController extends Controller
{
    /**
     * Writer Dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();
        $stats = [
            'total_articles' => $user->posts()->count(),
            'published_articles' => $user->posts()->where('status', 'published')->count(),
            'draft_articles' => $user->posts()->where('status', 'draft')->count(),
            'total_comments' => Comment::whereHas('post', function ($query) {
                $query->where('user_id', auth()->id());
            })->count(),
        ];

        $recent_articles = $user->posts()->latest()->limit(5)->get();
        $recent_comments = Comment::whereHas('post', function ($query) {
            $query->where('user_id', auth()->id());
        })->latest()->limit(5)->get();

        return view('writer.dashboard', compact('stats', 'recent_articles', 'recent_comments'));
    }

    /**
     * List all writer's articles
     */
    public function articles()
    {
        $articles = auth()->user()->posts()->paginate(15);
        return view('writer.articles.index', compact('articles'));
    }

    /**
     * Show create article form
     */
    public function createArticle()
    {
        $categories = Category::all();
        return view('writer.articles.create', compact('categories'));
    }

    /**
     * Store new article
     */
    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'status' => 'draft',
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $post = Post::create($data);

        return redirect(route('writer.articles'))->with('success', 'Artikel berhasil dibuat sebagai draft!');
    }

    /**
     * Show edit article form
     */
    public function editArticle($id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $categories = Category::all();
        return view('writer.articles.edit', compact('post', 'categories'));
    }

    /**
     * Update article
     */
    public function updateArticle(Request $request, $id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        $oldStatus = $post->status;

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $post->update($data);

        // If the post was just published, notify admins
        if ($oldStatus !== 'published' && $post->status === 'published') {
            $admins = User::where('role', 'admin')->pluck('email')->toArray();
            if (!empty($admins)) {
                Mail::to($admins)->send(new PostPublished($post));
            }
        }

        return redirect(route('writer.articles'))->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Delete article
     */
    public function deleteArticle($id)
    {
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $post->delete();

        return redirect('/writer/articles')->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Respond to comments
     */
    public function comments()
    {
        $comments = Comment::whereHas('post', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate(15);

        return view('writer.comments.index', compact('comments'));
    }

    public function replyComment(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Verify this comment is on the writer's post
        if ($comment->post->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk membalas komentar ini.');
        }

        $validated = $request->validate([
            'reply' => 'required|string|min:5|max:500',
        ]);

        // Store reply (kita anggap ada reply functionality di Comment model atau tabel terpisah)
        // For now, update comment dengan reply
        $comment->update(['reply' => $validated['reply']]);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }
}
