<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;

class TagRelationship extends Model
{
	public $timestamps = false;
    protected $table = 'posts_tags_relationships';
}
