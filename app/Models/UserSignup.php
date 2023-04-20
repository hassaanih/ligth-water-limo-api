<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserSignup extends Model
{
    use HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id',
        'password',
        'full_name',
        'email',
        'dial_code',
        'mobile_number',
        'profile_photo_path',
        'mobile_otp_verified',
        'email_otp_verified',
        'email_otp_code',
        'mobile_otp_code',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_type_id' => 'int',
        'password' => 'string',
        'full_name' => 'string',
        'email' => 'string',
        'dial_code' => 'string',
        'mobile_number' => 'string',
        'profile_photo_path' => 'string',
        'mobile_otp_verified' => 'boolean',
        'email_otp_verified' => 'boolean',
        'email_otp_code' => 'string',
        'mobile_otp_code' => 'string',
        'address' => 'string',
    ];
}
