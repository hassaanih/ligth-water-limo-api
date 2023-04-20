<?php

use App\Enums\UserType;
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
        Schema::create('user_signups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type_id')->nullable(false)->default(UserType::EMPLOYEE);
            $table->string('password', 100)->nullable(true);
            $table->string('full_name', 100)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('dial_code', 5)->nullable(true);
            $table->string('mobile_number', 20)->nullable(true);
            $table->string('profile_photo_path', 200)->nullable(true);
            $table->boolean('mobile_otp_verified')->nullable(false)->default(false);
            $table->boolean('email_otp_verified')->nullable(false)->default(false);
            $table->string('email_otp_code', 6)->nullable(true);
            $table->string('mobile_otp_code', 6)->nullable(true);
            $table->string('address')->nullable(true);
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
        Schema::dropIfExists('user_signups');
    }
};
