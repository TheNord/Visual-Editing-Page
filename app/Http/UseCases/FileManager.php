<?php

namespace App\Http\UseCases;

use Storage;
use Illuminate\Support\Collection;

class FileManager
{
    private $disk;

    public function __construct()
    {
        $this->disk = 'template_manage';
    }

    public function content($path)
    {
        $content = Storage::disk($this->disk)->listContents($path);

        // get a list of directories
        $directories = $this->filterDir($content);

        // get a list of files
        $files = $this->filterFile($content);

        return compact('directories', 'files');
    }

    /**
     * Get only directories
     *
     * @param $content
     *
     * @return array
     */
    protected function filterDir($content)
    {
        return Collection::make($content)
            ->where('type', 'dir')
            ->map(function ($item, $key) {
                return array_except($item, ['filename']);
            })
            ->values()
            ->all();
    }

    /**
     * Get only files
     *
     * @param $content
     *
     * @return array
     */
    protected function filterFile($content)
    {
        return Collection::make($content)
            ->where('type', 'file')
            ->values()
            ->all();
    }
}