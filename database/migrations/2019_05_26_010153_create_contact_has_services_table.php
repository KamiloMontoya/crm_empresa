<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactHasServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_has_services', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('contact_id')->unsigned()->nullable();
            $table->integer('service_id')->unsigned()->nullable();
            $table->string('cus');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_has_services');
    }
}
