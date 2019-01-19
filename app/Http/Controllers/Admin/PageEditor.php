<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PageEditor extends Controller
{
    public function start()
    {
        Session::put('interactive-editing', true);
        return redirect()->back();
    }

    public function stop()
    {
        Session::put('interactive-editing', false);
        return redirect()->back();
    }


    public function save(Request $request, Page $page)
    {
        $page->update([
            'content' => $request->body['main-content']
        ]);
        return response('Ok', 200);
    }
}
