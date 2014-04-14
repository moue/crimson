<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Posts` table
		Schema::create('posts', function($table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned(); 
			$table->integer('user_id')->unsigned();
			$table->unsignedInteger('section_id');
			$table->string('writer');
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->text('snippit');
			$table->string('img')->nullable();
			$table->string('photog')->nullable();
			$table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
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
		// Drop foreign key constraint
		Schema::table('posts', function($table) 
		{
			$table->dropForeign('posts_section_id_foreign');
		});

		// Delete the `Posts` table
		Schema::drop('posts');
	}

}
