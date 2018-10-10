<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleStatisticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_statistices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->nullable();
            $table->integer('article_rank_value')->nullable();
            $table->integer('fb_share')->nullable();
            $table->integer('twitter_share')->nullable();
            $table->integer('linkedIn_share')->nullable();
            $table->string('share_by_email')->nullable();
            $table->string('share_by_username')->nullable();
            $table->string('share_ip')->nullable();
            $table->timestamps();
        });

        Schema::table('article_statistices', function($table) {

            //if 'articals'  table  exists
            if(Schema::hasTable('articals'))
            {
                $table->foreign('article_id')->references('id')->on('articals')->onDelete('cascade');;
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
        Schema::dropIfExists('article_statistices');
    }
}
