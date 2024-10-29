<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display all published posts on the home page.
     */
    public function index()
    {
        $posts = Post::with('images')->get();
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $filename, 'public');
                $post->images()->create(['filename' => $filename]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post details.
     */
    public function show(string $id)
    {
        $post = Post::with('images')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(string $id)
    {
        $post = Post::with('images')->findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('images')) {
            foreach ($post->images as $image) {
                Storage::disk('public')->delete('images/' . $image->filename);
            }

            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $filename, 'public');
                $post->images()->create(['filename' => $filename]);
            }
        }

        $post->save();
        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        foreach ($post->images as $image) {
            Storage::disk('public')->delete('images/' . $image->filename);
        }

        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }

    /**
     * Display the user dashboard with only the user's posts.
     */
    public function dashboard()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
    }

    $posts = Post::where('user_id', Auth::id())->with('images')->get();
    return view('dashboard', compact('posts'));
}

    /**
     * Display a single post on the home page.
     */
    public function showInHome($id)
    {
        $post = Post::with('images')->findOrFail($id);
        return view('shows', compact('post'));
    }
}
