<?php

namespace App\UseCases;

use Cache;
use Storage;
use Illuminate\Support\Collection;

class FileManager
{
    private $disk;

    public function __construct()
    {
        $this->disk = 'template_manage';
    }

    /**
     * Get contents (files and folders) by path
     *
     * @param $path
     * @return array
     */
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
     * Get templates for pages
     *
     * @return array
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getPageTemplates()
    {
        $templates = [];

        $content = $this->content('/');

        foreach ($content['files'] as $file) {
            if (preg_match('|#Template Name:(.*)#|mi', $this->getFileContent($file['path']), $header)) {
                $templates[] = collect([
                    'path' => $file['path'],
                    'name' => trim($header[1])
                ]);
            }
        }

        return $templates;
    }

    public function checkExist($path)
    {
        return Storage::disk($this->disk)->exists($path);
    }

    /**
     * Get the content of a file by path
     *
     * @param $path
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getFileContent($path)
    {
        return Storage::disk('template_manage')->get($path);
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