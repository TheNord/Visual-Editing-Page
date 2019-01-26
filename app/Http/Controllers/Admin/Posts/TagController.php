<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Post\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-tags');
    }

    public function index()
    {
        $tags = Tag::all();

        return view('admin.posts.tags.index', compact('tags'));
    }

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

    public function edit(Tag $tag)
    {
        return view('admin.posts.tags.edit', compact('tag'));
    }

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

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.posts.tags.index');
    }
}
