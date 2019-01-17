<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberOfBidsToBiddingPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bidding_packages', function (Blueprint $table) {
            $table->integer('number_of_bids')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bidding_packages', function (Blueprint $table) {
            $table->dropColumn('number_of_bids');
        });
    }
}
