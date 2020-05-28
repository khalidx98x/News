<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('short_description');
            $table->longText('description');
            $table->string('slug');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->string('main_image')->nullable();
            $table->string('thumb_image')->nullable();
            $table->string('list_image')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('hot_news')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
