<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Menu;
use App\Entity\Page;
use App\Entity\Post\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menus\CreateRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-menu');
    }

    public function index()
    {
        $menus = Menu::defaultOrder()->withDepth()->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::defaultOrder()->withDepth()->get();
        $pages = Page::all();
        $categories = Category::all();

        return view('admin.menu.create', compact('parents', 'pages', 'categories'));
    }

    public function store(CreateRequest $request)
    {
        $menu = Menu::create([
            'title' => $request['title'],
            'page_id' => $request['page_id'],
            'category_id' => $request['category_id'],
            'parent_id' => $request['parent']
        ]);

        // if the category is selected assign type menu 1 (category)
        if ($request['category_id'] != null) {
            $menu->update([
                'page_id' => null,
                'type' => 1
            ]);
        }

        return redirect()->route('admin.menu.index', $menu);
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::defaultOrder()->withDepth()->get();
        $pages = Page::all();
        $categories = Category::all();

        return view('admin.menu.edit', compact('menu', 'parents', 'pages', 'categories'));
    }

    public function update(CreateRequest $request, Menu $menu)
    {
        $menu->update([
            'title' => $request['title'],
            'page_id' => $request['page_id'],
            'category_id' => $request['category_id'],
            'parent_id' => $request['parent'],
            'type' => 0
        ]);

        // if the category is selected assign type menu 1 (category)
        if ($request['category_id'] != null) {
            $menu->update([
                'page_id' => null,
                'type' => 1
            ]);
        }

        return redirect()->route('admin.menu.index', $menu);
    }

    /**
     * Change the position of menus items
     *
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function first(Menu $menu)
    {
        if ($first = $menu->siblings()->defaultOrder()->first()) {
            $menu->insertBeforeNode($first);
        }

        return redirect()->route('admin.menu.index');
    }

    public function up(Menu $menu)
    {
        $menu->up();

        return redirect()->route('admin.menu.index');
    }

    public function down(Menu $menu)
    {
        $menu->down();

        return redirect()->route('admin.menu.index');
    }

    public function last(Menu $menu)
    {
        if ($last = $menu->siblings()->defaultOrder('desc')->first()) {
            $menu->insertAfterNode($last);
        }

        return redirect()->route('admin.menu.index');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index');
    }
}