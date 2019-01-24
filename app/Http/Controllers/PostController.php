<?php

namespace App\Http\Controllers;

use App\Entity\Post\Category;
use App\Entity\Post\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function show(Category $category, Post $post)
    {
        dd($post);
    }

    public static function category(Category $category)
    {
        return view('template.category', compact('category'));
    }
}
