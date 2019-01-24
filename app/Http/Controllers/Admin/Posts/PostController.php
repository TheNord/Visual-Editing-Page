<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Post\Post;
use App\Entity\Post\Category;
use App\Entity\Post\Tag;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $statuses = Post::statusList();

        return view('admin.posts.create', compact('categories', 'tags', 'statuses'));
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
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'status' => ['required', 'string', 'max:255', Rule::in(array_keys(Post::statusList()))]
        ]);

        $post = Post::create([
            'title' => $request['title'],
            'slug' => str_slug($request['title']),
            'content' => $request['content'],
            'status' => $request['status'],
            'category_id' => $request['category'],
        ]);

        $post->setTags($request->tags);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $statuses = Post::statusList();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'statuses', 'categories', 'tags'));
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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'status' => ['required', 'string', 'max:255', Rule::in(array_keys(Post::statusList()))]
        ]);

        $post->update([
            'title' => $request['title'],
            'slug' => str_slug($request['title']),
            'content' => $request['content'],
            'status' => $request['status'],
            'category_id' => $request['category'],
        ]);

        $post->setTags($request->tags);

        return redirect()->route('admin.posts.index', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
