<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsExpiredToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->boolean('is_expired')->nullable()->default(1)->comment('0:Expired; 1:Not Expired');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->dropColumn('is_expired');
        });
    }
}
