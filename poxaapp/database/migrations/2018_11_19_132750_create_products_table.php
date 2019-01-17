<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('product_name', 191);
			$table->string('product_code', 191)->nullable();
			$table->text('description', 65535)->nullable();
			$table->float('price');
			$table->float('winer_user_id')->nullable()->comment('winner user id');
			$table->float('buy_now_price')->nullable();
			$table->text('meta_description', 65535)->nullable();
			$table->text('meta_keywords', 65535)->nullable();
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
		Schema::drop('products');
	}

}
