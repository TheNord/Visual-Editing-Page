<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\PageRequest;
use Illuminate\Support\Facades\Cache;
use App\UseCases\FileManager;

class PageController extends Controller
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->middleware('can:manage-pages');
        $this->fileManager = $fileManager;
    }

    public function index()
    {
        $pages = Page::defaultOrder()->withDepth()->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $parents = Page::defaultOrder()->withDepth()->get();
        $templates = $this->fileManager->getPageTemplates();

        return view('admin.pages.create', compact('parents', 'templates'));
    }

    public function store(PageRequest $request)
    {
        $page = Page::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent'],
            'content' => $request['content'],
            'keywords' => $request['keywords'],
            'description' => $request['description'],
            'template' => $request['template']
        ]);

        return redirect()->route('admin.pages.index', $page);
    }

    public function edit(Page $page)
    {
        $parents = Page::defaultOrder()->withDepth()->get();
        $templates = $this->fileManager->getPageTemplates();

        return view('admin.pages.edit', compact('page', 'parents', 'templates'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent'],
            'content' => $request['content'],
            'keywords' => $request['keywords'],
            'description' => $request['description'],
            'template' => $request['template']
        ]);

        Cache::forget('page_path_' . $page->id);

        return redirect()->route('admin.pages.index', $page);
    }

    public function destroy(Page $page)
    {
        $page->delete();
        Cache::forget('page_path_' . $this->page->id);
        return redirect()->route('admin.pages.index');
    }
}