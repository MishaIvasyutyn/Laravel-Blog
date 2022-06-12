<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->paginate(5);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags|min:3|alpha_dash',
        ]);
        Tag::create($request->all());
        $request->session()->flash('success', 'Tag created successfully');
        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags|min:3|alpha_dash',
        ]);

        $tag = Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag->posts->count() > 0) {
            return redirect()->route('admin.tags.index')->with('error', 'Tag is used in some post, can\'t delete');
        }
        Tag::destroy($id);
        return redirect()->back()->with('success', 'Tag deleted successfully');
    }

    public  function show($slug)
    {
        $tag=Tag::where('slug',$slug)->firstOrFail();
        $posts=$tag->posts()->with('category')->orderByDesc('id')->paginate(5);
        return view('tags.show',compact('tag','posts'));

    }
}
