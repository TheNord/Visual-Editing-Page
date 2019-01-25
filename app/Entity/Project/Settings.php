<?php

namespace App\Entity\Project;

use App\Entity\Page;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Settings extends Model
{
    protected $fillable = ['name', 'value'];

    public $timestamps = false;

    public function getHome()
    {
        $page = Settings::where('name', 'home_page')->first();

        if(is_null($page->value)) {
            return 'Not set';
        }

        $page = Page::find($page->value);

        return $page;
    }

    public function getRegistrationStatus()
    {
        return Settings::where('name', 'registration_access')->first()->value;
    }
}