<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Menu;
use App\Entity\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::defaultOrder()->withDepth()->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::defaultOrder()->withDepth()->get();
        $pages = Page::all();

        return view('admin.menu.create', compact('parents', 'pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'page_id' => 'required|integer|exists:pages,id',
            'parent_id' => 'nullable|integer|exists:menu,id'
        ]);

        $page = Menu::create([
            'title' => $request['title'],
            'page_id' => $request['page_id'],
            'parent_id' => $request['parent']
        ]);

        return redirect()->route('admin.menu.index', $page);
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::defaultOrder()->withDepth()->get();
        $pages = Page::all();

        return view('admin.menu.edit', compact('menu', 'parents', 'pages'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required',
            'page_id' => 'required|integer|exists:pages,id',
            'parent_id' => 'nullable|integer|exists:menu,id'
        ]);

        $menu->update([
            'title' => $request['title'],
            'page_id' => $request['page_id'],
            'parent_id' => $request['parent']
        ]);

        return redirect()->route('admin.menu.index', $menu);
    }

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