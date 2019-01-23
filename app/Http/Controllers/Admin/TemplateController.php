<?php

namespace App\Http\Controllers\Admin;

use App\Http\UseCases\FileManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class TemplateController extends Controller
{
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function index() {
    	return view('admin.template-manager.index');
    }

    public function explore(Request $request)
    {
        return response()->json(
            $this->fileManager->content($request->input('path'))
        );

    }

    public function load(Request $request) {
    	return Storage::disk('template_manage')->download($request->input('path'));
    }

    public function update(Request $request) {
    	$result = Storage::disk('template_manage')->put($request->input('path'), $request->input('code'));
    	return response(['result' => $result], 200);
    }

    private function getPath($template) {
    	switch ($template) {
		    case 'header':
		        $path = '/layouts/partials/header.blade.php';
		        break;
		    case 'footer':
		        $path = '/layouts/partials/footer.blade.php';
		        break;
		    case 'top_menu':
		        $path = '/layouts/partials/top_menu.blade.php';
		        break;    
		    case 'page':
		        $path = '/page.blade.php';
		        break;
		}

		return $path;
    }
}
