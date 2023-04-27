<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $full_name
 * @property string  $email
 * @property string  $password
 * @property string  $remember_token
 * @property string  $dial_code
 * @property string  $mobile_number
 * @property string  $profile_photo_path
 * @property string  $email_otp_code
 * @property string  $mobile_otp_code
 * @property string  $address
 * @property int     $email_verified_at
 * @property int     $user_type_id
 * @property int     $created_at
 * @property int     $updated_at
 * @property boolean $mobile_otp_verified
 * @property boolean $email_otp_verified
 */
class Users extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'email_verified_at', 'password', 'remember_token', 'user_type_id', 'dial_code', 'mobile_number', 'profile_photo_path', 'mobile_otp_verified', 'email_otp_verified', 'email_otp_code', 'mobile_otp_code', 'address', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'full_name' => 'string', 'email' => 'string', 'email_verified_at' => 'timestamp', 'password' => 'string', 'remember_token' => 'string', 'user_type_id' => 'int', 'dial_code' => 'string', 'mobile_number' => 'string', 'profile_photo_path' => 'string', 'mobile_otp_verified' => 'boolean', 'email_otp_verified' => 'boolean', 'email_otp_code' => 'string', 'mobile_otp_code' => 'string', 'address' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'email_verified_at', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
