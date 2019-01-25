<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public $timestamps = false;

    protected $table = 'posts_tags';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
