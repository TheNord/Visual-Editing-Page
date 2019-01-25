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

    public function shortlyContent()
    {
        $content = $this->content;
        $content = strip_tags($content);
        $content = substr($content, 0, 400);
        $content = rtrim($content, "!,.-");
        $content = substr($content, 0, strrpos($content, ' '));
        return $content."… ";
    }

    public function hasMiniature() 
    {
        return !!$this->miniature;
    }

    public function hasTags()
    {
        return $this->tags()->count() > 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
