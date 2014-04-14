<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleRanking extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('placements', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->unsignedInteger('post_id');
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
		Schema::drop('placement');
	}

}
