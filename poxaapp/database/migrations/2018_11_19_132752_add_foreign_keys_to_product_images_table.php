<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_images', function(Blueprint $table)
		{
			$table->foreign('product_id', 'products_image_product_id_foreign')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_images', function(Blueprint $table)
		{
			$table->dropForeign('products_image_product_id_foreign');
		});
	}

}
