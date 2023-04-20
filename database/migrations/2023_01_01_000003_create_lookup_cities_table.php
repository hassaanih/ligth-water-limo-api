<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id');
            $table->string('name', 255);
            $table->string('blueex_code', 10)->nullable(true);
            $table->unsignedInteger('state_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['country_id', 'state_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookup_cities');
    }
}
