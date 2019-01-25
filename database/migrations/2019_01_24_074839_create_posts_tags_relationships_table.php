<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTagsRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_tags_relationships', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
            $table->foreign('tag_id')->references('id')->on('posts_tags')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_tags_relationships');
    }
}
