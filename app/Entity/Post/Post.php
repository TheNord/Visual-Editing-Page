<?php

namespace App\Entity\Post;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Post\Tag;
use App\Entity\Post\Category;

class Post extends Model
{
    protected $guarded = [];

    const TYPE_DRAFT = 'draft';
    const TYPE_PUBLISHED = 'published';

    public static function statusList()
    {
        return [
            self::TYPE_DRAFT => 'Черновик',
            self::TYPE_PUBLISHED => 'Опубликован',
        ];
    }   

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'posts_tags_relationships',
            'post_id',
            'tag_id'
        );
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function setTags($ids)
    {
        if($ids == null) {return;}
        $this->tags()->sync($ids);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
