<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index');
    }

    public function posts()
    {
        $posts = Post::latest()->get();
        $data = [];
        foreach ($posts as $post) {
            array_push($data, [
                'id' => $post->id,
                'image' => asset('storage/' . $post->image),
                'title' => $post->title,
                'category' => $post->category->title,
                'tags' => $post->tags,
                'author' => $post->user->name,
                'status' => $post->status === 1 ? 'PUBLISH' : 'PENDING',
                'link_edit' => route('admin.post.edit', $post->id)
            ]);
        }
        return $data;
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('title', 'id');
        $tags = Tag::all()->pluck('title', 'id');
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'tags' => ['required', 'array'],
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required'],
            'image' => ['required', 'image', 'max:3000'],
            'status' => ['required', 'integer']
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($request->title) . '-' . (Post::getLatestId() + 1);
        $validated['image'] = $request->file('image')->store('posts', 'public');
        $post = Post::create($validated);
        $post->tags()->attach($request->tags);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('title', 'id');
        $tags = Tag::all()->pluck('title', 'id');
        return view('admin.post.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $this->validate($request, [
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'tags' => ['required', 'array'],
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required'],
            'image' => ['nullable', 'image', 'max:3000'],
            'status' => ['required', 'integer']
        ]);

        $validated['slug'] = Str::slug($request->title) . '-' . $post->id;
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
            Storage::delete('public/' . $post->image);
        }

        $post->update($validated);
        $post->tags()->sync($request->tags);
        return back()->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->image);
        return $post->delete();
    }
}
