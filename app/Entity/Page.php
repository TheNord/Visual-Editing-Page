<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property int $id
 * @property string $title
 * @property string $menu_title
 * @property string $slug
 * @property string $content
 * @property string $description
 * @property int|null $parent_id
 *
 */
class Page extends Model
{
    use NodeTrait;

    protected $guarded = [];

    public function hasDescription()
    {
        return !!$this->description;
    }

    public function hasKeywords()
    {
        return !!$this->keywords;
    }

    /** Get full path to the page */
    public function getPath(): string
    {
        return implode('/', array_merge($this->ancestors()->defaultOrder()->pluck('slug')->toArray(), [$this->slug]));
    }

    public function hasChildren()
    {
        return ($this->children()->count() > 0) ? true : false;
    }
}