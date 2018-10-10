<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->nullable();
            $table->string('site_url')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('shared_user_id')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->timestamps();
        });

        Schema::table('article_shares', function($table) {

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
        Schema::dropIfExists('article_shares');
    }
}
