<?php

namespace App\Http\Controllers\Admin;

use App\UseCases\FileManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class TemplateController extends Controller
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->middleware('can:manage-templates');
    }

    public function index()
    {
        return view('admin.template-manager.index');
    }

    public function explore(Request $request)
    {
        return response()->json(
            $this->fileManager->content($request->input('path'))
        );

    }

    public function load(Request $request)
    {
        return Storage::disk('template_manage')->download($request->input('path'));
    }

    public function update(Request $request)
    {
        $result = Storage::disk('template_manage')->put($request->input('path'), $request->input('code'));
        return response(['result' => $result], 200);
    }
}
