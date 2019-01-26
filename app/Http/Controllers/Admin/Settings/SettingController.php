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

    /**
     * Home page setting
     */
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

    /**
     * Registration access setting
     */
    public function registration()
    {
        $current = Settings::where('name', 'registration_access')->first()->value;

        return view('admin.settings.registration.change', compact('current'));
    }

    public function updateRegistration(Request $request, Settings $settings)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $registrationStatus = Settings::where('name', 'registration_access')->first();

        $registrationStatus->update([
            'value' => $request->status
        ]);

        return redirect()->route('admin.settings.index');
    }

    /**
     * Contact email address setting
     */
    public function contact()
    {
        $current = Settings::where('name', 'email_to')->first()->value;

        return view('admin.settings.contact.change', compact('current'));
    }

    public function updateContact(Request $request, Settings $settings)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = Settings::where('name', 'email_to')->first();

        $email->update([
            'value' => $request->email
        ]);

        return redirect()->route('admin.settings.index');
    }
}
