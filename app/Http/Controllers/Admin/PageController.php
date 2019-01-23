<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\PageRequest;
use App\Http\UseCases\FileManager;

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

    /**
     * Create new page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function create()
    {
        $parents = Page::defaultOrder()->withDepth()->get();
        $templates = $this->fileManager->getPageTemplate();

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

    /**
     * Edit existing page
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function edit(Page $page)
    {
        $parents = Page::defaultOrder()->withDepth()->get();
        $templates = $this->fileManager->getPageTemplates();

        return view('admin.pages.edit', compact('page', 'parents', 'templates'));
    }

    public function update(PageRequest $request, Page $page)
    {
        //dd($request['template']);
        $page->update([
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

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index');
    }
}