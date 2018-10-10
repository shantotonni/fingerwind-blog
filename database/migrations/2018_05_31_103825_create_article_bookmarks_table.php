<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_bookmarks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip')->nullable();
            $table->integer('bookmark')->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
        });

        Schema::table('article_bookmarks', function($table) {

            //if 'articals'  table  exists
            if(Schema::hasTable('articals'))
            {
                $table->foreign('article_id')->references('id')->on('articals')->onDelete('cascade');;
            }

            //if 'users'  table  exists
            if(Schema::hasTable('users'))
            {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_bookmarks');
    }
}
