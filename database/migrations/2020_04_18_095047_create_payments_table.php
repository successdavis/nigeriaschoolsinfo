<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount'); //record payments and discount as negative, record refund as positive
            $table->string('method')->nullable(); // what method did the user used to make this payment
            $table->string('description'); // what is the user paying for?
            $table->string('transaction_ref'); // The transaction references generated from the payment
            $table->boolean('paid')->default(false); // 0 => Initialized, 1 => Paid
            $table->integer('billable_id');
            $table->string('billable_type'); // get the Model this invoice is created for e.g. Course, Certificates, etc.
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
        Schema::dropIfExists('payments');
    }
}
