<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index('products_image_product_id_foreign');
			$table->string('image_name', 191);
			$table->boolean('status')->nullable()->default(1)->comment('0:De-active; 1:Active');
			$table->boolean('is_delete')->nullable()->default(1)->comment('0:Deleted; 1:Not Deleted');
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
		Schema::drop('product_images');
	}

}
