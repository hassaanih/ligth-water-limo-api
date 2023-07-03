<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->date('pickup_date')->nullable(false);
            $table->time('pickup_time')->nullable(false);
            $table->integer('total_stops')->nullable(false)->default(0);
            $table->string('pickup_location')->nullable(false);
            $table->string('drop_location')->nullable(false);
            $table->integer('travellers')->nullable(false)->default(0);
            $table->integer('kids')->nullable(false)->default(0);
            $table->integer('bags')->nullable(false)->default(0);
            $table->float('total_km', 75, 4)->nullable(false)->default(0);
            $table->float('vehicle_charges', 75, 2)->nullable(true)->default(0);
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
        Schema::dropIfExists('booking_details');
    }
};
