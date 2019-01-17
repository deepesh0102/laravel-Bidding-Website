<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBidingHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('biding_histories', function(Blueprint $table)
		{
			$table->foreign('auction_id')->references('id')->on('auctions')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('biding_histories', function(Blueprint $table)
		{
			$table->dropForeign('biding_histories_auction_id_foreign');
			$table->dropForeign('biding_histories_product_id_foreign');
			$table->dropForeign('biding_histories_user_id_foreign');
		});
	}

}
