<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidingPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidding_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price')->nullable()->default(0.00);
            $table->string('name', 191);
            $table->boolean('status')->default(1)->comment('0:Inactive; 1:Active');
            $table->boolean('is_delete')->default(1)->comment('0:Deleted; 1:Not Deleted');
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
        Schema::dropIfExists('bidding_packages');
    }
}
