<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Entity\Page;
use App\Entity\Project\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Settings $settings)
    {
        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function changeHome()
    {
        $current = Settings::where('name', 'home_page')->first();

        $pages = Page::all()->sortByDesc('created_at');

        return view('admin.settings.home.change', compact('current', 'pages'));
    }

    public function updateHome(Request $request, Settings $settings)
    {
        $request->validate([
            'page' => 'required'
        ]);

        $homePage = Settings::where('name', 'home_page')->first();

        $homePage->update([
            'value' => $request->page
        ]);

        return redirect()->route('admin.settings.index');
    }
}