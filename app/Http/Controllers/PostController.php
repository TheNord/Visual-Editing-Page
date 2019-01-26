<?php

namespace App\Http\Controllers;

use App\Entity\Post\Category;
use App\Entity\Post\Post;
use Illuminate\Http\Request;
use App\Http\Middleware\ProcessWidgets;

class PostController extends Controller
{
	public function __construct()
    {
        $this->middleware(ProcessWidgets::class);
    }

    /**
     * Show post for this category
     *
     * @param Category $category
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function show(Category $category, Post $post)
    {
    	return view('template.post', compact('category', 'post'));
    }

    /**
     * Show all posts for this category
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function category(Category $category)
    {
        return view('template.category', compact('category'));
    }
}
