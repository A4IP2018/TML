<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		
		Schema::create('users', function(Blueprint $table) {
		
		    $table->increments('id');
		    $table->string('email');
		    $table->string('password');
		    $table->integer('role_id');
		    $table->string('reset_token');
		    $table->string('register_token');
		    $table->boolean('is_confirmed');
		    $table->rememberToken();
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
		Schema::dropIfExists('users');

    }
}