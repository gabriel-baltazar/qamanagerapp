<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_index'), 403);

        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_create'), 403);

        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), 403);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), 403);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), 403);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
