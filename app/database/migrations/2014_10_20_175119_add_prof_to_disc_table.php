<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfToDiscTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('disciplinas', function(Blueprint $table)
		{
			$table->integer('professor_id')->nullable();
			$table->foreign('professor_id')->references('id')->on('professores');			

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
