<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAutoBiddersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auto_bidders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->boolean('status')->nullable()->default(1)->comment('0:De-active; 1:Active');
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
		Schema::drop('auto_bidders');
	}

}
