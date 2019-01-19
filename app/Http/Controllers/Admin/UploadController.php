<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request): string
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $file = $request->file('file');
        return asset($file->store('/uploads/images'));
    }

    public function imagePage(Request $request): array
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $file = $request->file('file');
        $url = asset($file->store('/uploads/images'));
        return [
            'size' => getimagesize($file),
            'url' => $url];
    }
}