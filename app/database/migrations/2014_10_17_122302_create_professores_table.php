<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('professores', function($table)
        {
        	$table->increments('id')->unsigned();	
            $table->string('nome', 255);
            $table->text('biografia');
            $table->string('titulo_academico', 255);
            $table->string('slug');
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
        Schema::drop('professores');
	}

}