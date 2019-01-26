<?php

namespace App\Http\Controllers;

use App\Entity\Page;
use App\Entity\Project\Settings;
use App\Http\Middleware\ProcessWidgets;
use App\Http\Router\PagePath;
use App\UseCases\FileManager;

class PageController extends Controller
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->middleware(ProcessWidgets::class);
        $this->fileManager = $fileManager;
    }

    /**
     * Show single page
     *
     * @param PagePath $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(PagePath $path)
    {
        $page = $path->page;
        $template = $this->getTemplate($page);

        return view($template, compact('page'));
    }

    /**
     * Show home page (homepage is set in settings)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHome()
    {
        $pageId = Settings::where('name', 'home_page')->first();
        $page = Page::find($pageId->value);
        $template = $this->getTemplate($page);

        return view($template, compact('page'));
    }

    /**
     * Get template for page
     *
     * @param $page
     * @return string
     */
    private function getTemplate($page)
    {
        return $this->fileManager->checkExist($page->template) ?
               'template.' . rtrim($page->template, '.blade.php') :
               'template.page';
    }
}