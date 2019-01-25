<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = false;
	
    protected $guarded = [];
    protected $table = 'posts_categories';

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function hasDescription()
    {
        return !!$this->description;
    }

    public function hasPosts()
    {
        return !!$this->posts();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
