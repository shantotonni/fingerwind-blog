<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('roles_id')->nullable();
            $table->unsignedInteger('permissions_id')->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->integer('created_by', false, 11)->nullable();
            $table->integer('updated_by', false, 11)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::table('role_permissions', function($table) {

            //if 'articals'  table  exists
            if(Schema::hasTable('roles'))
            {
                $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');;
            }

            //if 'users'  table  exists
            if(Schema::hasTable('permissions'))
            {
                $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');;
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
        Schema::dropIfExists('role_permissions');
    }
}
