<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auctions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index('auctions_product_id_foreign');
			$table->string('start_time', 191)->nullable();
			$table->string('end_time', 191)->nullable();
			$table->float('price_inc')->nullable()->default(0.00);
			$table->integer('time_inc')->unsigned()->nullable()->default(0);
			$table->integer('min_real_bids')->unsigned()->nullable()->default(0);
			$table->integer('autobid_limit')->unsigned()->nullable()->default(0);
			$table->boolean('auction_status')->nullable()->default(1)->comment('1:Live');
			$table->boolean('status')->nullable()->default(0)->comment('0:De-active; 1:Active');
			$table->boolean('is_sold')->nullable()->default(0)->comment('1:solded');
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
		Schema::drop('auctions');
	}

}
