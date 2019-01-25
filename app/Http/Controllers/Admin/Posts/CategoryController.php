<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Post\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.posts.categories.index', compact('categories'));
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
            'name' => 'required|unique:posts_categories',
            'slug' => 'required|unique:posts_categories'
        ]);

        $category = Category::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'description' => $request['description']
        ]);

        return redirect()->route('admin.posts.categories.index', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.posts.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:posts_categories,name,'.$category->id,
            'slug' => 'required|unique:posts_categories,slug,'.$category->id
        ]);

        $category->update([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'description' => $request['description']
        ]);

        return redirect()->route('admin.posts.categories.index', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.posts.categories.index');
    }
}
