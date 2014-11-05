<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinaUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('disciplinas_usuarios', function($table)
        {
        	$table->increments('id')->unsigned();	
			$table->integer('user_id')->unique();
			$table->foreign('user_id')->references('id')->on('usuarios');			        		
			$table->integer('disciplina_id')->unique();
			$table->foreign('disciplina_id')->references('id')->on('disciplinas');			        		
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
        Schema::drop('disciplinas_usuarios');
	}

}
