	<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsDisciplina extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('disciplinas', function($table)
		{
			$table->integer('dia_semana')->nullable(); //seg, ter, qua..
			$table->time('check_in_inicio')->nullable();
			$table->time('check_in_final')->nullable();
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
