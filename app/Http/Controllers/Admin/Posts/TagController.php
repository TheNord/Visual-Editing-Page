<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Post\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.posts.tags.index', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:posts_tags',
            'slug' => 'required|unique:posts_tags'
        ]);

        $tag = Tag::create([
            'name' => $request['name'],
            'slug' => $request['slug']
        ]);

        return redirect()->route('admin.posts.tags.index', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.posts.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|unique:posts_tags,name,'.$tag->id,
            'slug' => 'required|unique:posts_tags,slug,'.$tag->id
        ]);

        $tag->update([
            'name' => $request['name'],
            'slug' => $request['slug']
        ]);

        return redirect()->route('admin.posts.tags.index', $tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.posts.tags.index');
    }
}
