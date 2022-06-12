<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->with('category','tags')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $data = $request->all();
        $data['thumbnail'] = Post::UploadImage($request, $post->thumbnail);
        $post->update($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['thumbnail'] = Post::UploadImage($request);
        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]);
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');

    }
}
