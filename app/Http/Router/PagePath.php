<?php

namespace App\Http\Router;

use App\Entity\Page;
use App\Entity\Post\Category;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PagePath implements UrlRoutable
{
    /**
     * @var Page
     */
    public $page;

    public function withPage(Page $page): self
    {
        $clone = clone $this;
        $clone->page = $page;
        return $clone;
    }

    public function getRouteKey()
    {
        if (!$this->page) {
            throw new \BadMethodCallException('Empty page.');
        }

        return Cache::rememberForever('page_path_' . $this->page->id, function () {
            return $this->page->getPath();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'page_path';
    }

    public function resolveRouteBinding($value)
    {
        $chunks = explode('/', $value);
        /** @var Page|null $page */
        $page = null;
        do {
            // берем первый элемент из адреса
            $slug = reset($chunks);
            // ищем страницы по указанному слагу, где parent_id равен ид текущей страницы или ноль (если это родитель)
            if ($slug && $next = Page::where('slug', $slug)->where('parent_id', $page ? $page->id : null)->first()) {
                $page = $next;
                // убираем последний элемент из адреса
                array_shift($chunks);
            }
            // проходим циклом пока slug и next не будут пустыми (пройдем всю цепочку адреса)
        } while (!empty($slug) && !empty($next));

        if (!empty($chunks)) {
            abort(404);
        }

        return $this
            ->withPage($page);
    }
}