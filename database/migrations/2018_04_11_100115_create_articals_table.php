<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->unsignedInteger('post_by')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('word_count')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_delete')->default(0);
            $table->integer('view_count')->default(0);
            $table->string('content_unique')->nullable();
            $table->string('country_code')->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
        });

        Schema::table('articals', function($table) {
            //if 'users'  table  exists
            if(Schema::hasTable('users'))
            {
                $table->foreign('post_by')->references('id')->on('users')->onDelete('cascade');;
            }

            //if 'categories'  table  exists
            if(Schema::hasTable('categories'))
            {
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');;
            }

            //if 'users'  table  exists
            if(Schema::hasTable('sub_categories'))
            {
                $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');;
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
        Schema::dropIfExists('articals');
    }
}
