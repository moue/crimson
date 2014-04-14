<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLayoutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('layouts');

		Schema::create('layouts', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->boolean('recent')->default(true);
			$table->boolean('custom')->default(false);
			$table->boolean('mixed')->default(false);
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
		//
	}

}
