<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSendMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_send_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('user_send_mails', function($table) {

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
        Schema::dropIfExists('user_send_mails');
    }
}
