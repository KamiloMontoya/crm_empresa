<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_has_service_id');
            $table->string('status');
            $table->integer('date_of_issue');
            $table->integer('payment_date');
            $table->integer('expiration_date');
            $table->integer('subtotal');
            $table->integer('duty_percent')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('duty');
            $table->integer('total');
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
        Schema::dropIfExists('invoices');
    }
}
