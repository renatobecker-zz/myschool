<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatasToDisciplinas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('disciplinas', function(Blueprint $table)
		{
			$table->date('inicio_semestre')->nullable();
			$table->date('fim_semestre')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('disciplinas', function(Blueprint $table)
		{
			//
		});
	}

}
