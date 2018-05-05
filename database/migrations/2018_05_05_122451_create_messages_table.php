<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		

		Schema::create('messages', function(Blueprint $table) {
		
		    $table->increments('id');
		    $table->integer('user_id_sender');
		    $table->integer('user_id_receiver');
		    $table->string('subject')->nullable();
		    $table->text('content')->nullable();		
		    $table->rememberToken();
		    $table->timestamps();
		
		});


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('messages');

    }
}