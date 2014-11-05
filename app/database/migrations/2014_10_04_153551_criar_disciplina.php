<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CriarDisciplina extends Migration {
 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinas', function($table)
        {
        	$table->increments('id')->unsigned();	
            $table->string('nome', 255);
            $table->text('descricao');
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
        Schema::drop('disciplinas');
    }
 
}