<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
			$table->string('username',100)->nullable();
			$table->string('access_token')->nullable();
        	$table->string('access_toker_secret')->nullable();
        	$table->biginteger('uid')->nullable();

			$table->unique('username');

        	$table->index('username');
        	$table->index('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
			//
		});
	}

}
