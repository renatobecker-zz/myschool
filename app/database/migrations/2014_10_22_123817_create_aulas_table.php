<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAulasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('aulas', function($table)
        {
        	$table->increments('id')->unsigned();
			$table->integer('professor_id');
			$table->foreign('professor_id')->references('id')->on('professores');			        	
			$table->integer('disciplina_id');
			$table->foreign('disciplina_id')->references('id')->on('disciplinas');			        	
        	$table->date('data');	
            $table->string('titulo', 255);
            $table->text('descricao');
            $table->string('slug');
            $table->timestamps();
            $table->unique( array('disciplina_id','data') );
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('aulas');
	}

}
