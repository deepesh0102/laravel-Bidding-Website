<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->integer('parent_id');
			$table->text('meta_description', 65535)->nullable();
			$table->text('meta_keywords', 65535)->nullable();
			$table->string('image', 191)->nullable();
			$table->boolean('featured')->nullable()->default(0);
			$table->boolean('status')->default(1)->comment('0:Inactive; 1:Active');
			$table->boolean('is_delete')->default(1)->comment('0:Deleted; 1:Not Deleted');
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
		Schema::drop('categories');
	}

}
