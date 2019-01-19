<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;

    protected $guarded = [];

    public function hasChildren()
    {
        return ($this->children()->count() > 0) ? true : false;
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}