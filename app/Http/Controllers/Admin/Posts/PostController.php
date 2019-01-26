<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Requests\Admin\Posts\CreateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Post\Post;
use App\Entity\Post\Category;
use App\Entity\Post\Tag;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-posts');
    }

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

    public function store(CreateRequest $request)
    {
        $post = Post::create([
            'title' => $request['title'],
            'slug' => str_slug($request['title']),
            'content' => $request['content'],
            'status' => $request['status'],
            'category_id' => $request['category'],
            'description' => $request['description'],
            'keywords' => $request['keywords'],
        ]);

        if ($request->file('miniature') != null) {
            $post->miniature = $request->file('miniature')->store('uploads/miniature');
            $post->save();
        }

        $post->setTags($request->tags);

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {   
        $statuses = Post::statusList();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'statuses', 'categories', 'tags'));
    }

    public function update(CreateRequest $request, Post $post)
    {
        $post->update([
            'title' => $request['title'],
            'slug' => str_slug($request['title']),
            'content' => $request['content'],
            'status' => $request['status'],
            'category_id' => $request['category'],
            'description' => $request['description'],
            'keywords' => $request['keywords'],
        ]);

        if ($request->file('miniature') != null) {
            $post->miniature = $request->file('miniature')->store('uploads/miniature');
            $post->save();
        }

        $post->setTags($request->tags);

        return redirect()->route('admin.posts.index', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
