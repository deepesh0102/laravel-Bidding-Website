<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bidding_package_id')->unsigned()->index('bidding_package_id_foreign');
            $table->foreign('bidding_package_id')->references('id')->on('bidding_packages')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->integer('user_id')->unsigned()->index('user_id_foreign')->comment('user id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->integer('transaction_id')->nullable()->index('transaction_id')->comment('Transaction Id');
            $table->string('payment_status', 191)->nullable()->index('payment_status')->comment('Payment Status');
            $table->float('payment_amount')->nullable()->default(0.00);
            $table->string('payment_currency', 191)->nullable()->index('payment_currency')->comment('Payment Currency');
            $table->string('payer_email', 191)->nullable()->index('payer_email')->comment('Payer Email');
            $table->string('receiver_email', 191)->nullable()->index('receiver_email')->comment('Receiver Email');
            $table->string('invoice_number', 191)->nullable()->index('invoice_number')->comment('Invoice Number');
            $table->ipAddress('ipaddress')->nullable()->index('ipaddress')->comment('IP Address');
            $table->boolean('download_status')->nullable()->default(0)->comment('0:Not Downloaded; 1:Downloaded');
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
        Schema::dropIfExists('user_packages');
    }
}
