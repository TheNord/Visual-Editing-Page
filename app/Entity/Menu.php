<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Entity\Post\Category;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}