<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate('4');
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->views++;
        $post->save();
        return view('posts.show', compact('post'));
    }

    public function search(Request $request){
        $request->validate([
            'search' => 'required|min:3'
        ]);
        $search=$request->search;
        $posts = Post::search($search,['title','content'])->with('category')->paginate('4');
        return view('posts.search', compact('posts', 'search'));

    }
}
