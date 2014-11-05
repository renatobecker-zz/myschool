<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToProfessorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('professores', function(Blueprint $table)
		{
			$table->integer('user_id')->nullable()->unique();
			$table->foreign('user_id')->references('id')->on('usuarios');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('professores', function(Blueprint $table)
		{
			//
		});
	}

}
