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

    public static function show(Category $category, Post $post)
    {
    	return view('template.post', compact('category', 'post'));
    }

    public static function category(Category $category)
    {
        return view('template.category', compact('category'));
    }
}
