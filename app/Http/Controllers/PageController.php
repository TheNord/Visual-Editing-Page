<?php

namespace App\Http\Controllers;

use App\Entity\Page;
use App\Entity\Project\Settings;
use App\Http\Middleware\ProcessWidgets;
use App\Http\Router\PagePath;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(ProcessWidgets::class);
    }
    public function show(PagePath $path)
    {
        $page = $path->page;
        return view('page', compact('page'));
    }

    public function showHome()
    {
        // need cache
        $pageId = Settings::where('name', 'home_page')->first();
        $page = Page::find($pageId->value);
        return view('page', compact('page'));
    }
}