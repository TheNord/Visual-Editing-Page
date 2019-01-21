<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Widget;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class WidgetsController extends Controller
{
    public function index()
    {
        $widgets = Widget::all();
        return view('admin.widgets.index', compact('widgets'));
    }

    public function create()
    {
        return view('admin.widgets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'template' => 'required',
        ]);

        $widget = Widget::create([
            'name' => $request['name'],
            'template' => $request['template'],
        ]);

        $this->clearCache($widget->id);

        return redirect()->route('admin.widgets.index', $widget);
    }

    public function edit(Widget $widget)
    {
        return view('admin.widgets.edit', compact('widget'));
    }

    public function update(Request $request, Widget $widget)
    {
        $request->validate([
            'name' => 'required',
            'template' => 'required',
        ]);

        $widget->update([
            'name' => $request['name'],
            'template' => $request['template'],
        ]);

        $this->clearCache($widget->id);

        return redirect()->route('admin.widgets.index', $widget);
    }

    public function clearCache($widgetId)
    {
        $path = resource_path() . "/views/widgets/widget-$widgetId.blade.php";
        $file = new Filesystem;
        $file->delete($path);
    }

    public function destroy(Widget $widget)
    {
        $widget->delete();
        return redirect()->route('admin.widgets.index');
    }
}

