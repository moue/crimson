<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFrontpagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('frontpages');

		Schema::create('frontpages', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->unsignedInteger('parent_id');
			$table->unsignedInteger('post_id');
			$table->string('title');
			$table->unsignedInteger('order');
			$table->timestamps();
			$table->foreign('post_id')->references('id')->on('posts');
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
