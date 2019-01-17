<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBidingHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('biding_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index('product_id');
			$table->integer('auction_id')->unsigned()->index('auction_id');
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->boolean('is_winner')->nullable()->default(0)->comment('1:winner');
			$table->boolean('bid_type')->nullable()->default(1)->comment('0:Auto Bid; 1:Bid');
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
		Schema::drop('biding_histories');
	}

}
