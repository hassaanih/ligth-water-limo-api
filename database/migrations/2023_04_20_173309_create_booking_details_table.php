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
        Schema::create('booking_meta', function (Blueprint $table) {
            $table->id();
            $table->date('pickup_date')->nullable(false);
            $table->time('pickup_time')->nullable(false);
            $table->integer('total_stops')->nullable(false);
            $table->string('pickup_location')->nullable(false);
            $table->string('drop_location')->nullable(false);
            $table->integer('travellers')->nullable(false);
            $table->integer('kids')->nullable(false);
            $table->integer('bags')->nullable(false);
            $table->float('total_km', 5, 2)->nullable(false);
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
        Schema::dropIfExists('booking_meta');
    }
};
