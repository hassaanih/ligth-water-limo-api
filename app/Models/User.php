<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
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
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be appends in response.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url'
    ];

    /**
     * Return url for image
     *
     */
    public function getProfilePhotoUrlAttribute()
    {
        return empty($this->profile_photo_path) ? null : asset('storage/' . $this->profile_photo_path);
    }
}
