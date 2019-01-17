<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('auctions', function(Blueprint $table)
		{
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('auctions', function(Blueprint $table)
		{
			$table->dropForeign('auctions_product_id_foreign');
		});
	}

}
