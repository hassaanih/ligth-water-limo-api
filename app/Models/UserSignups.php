<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $user_type_id
 * @property int     $created_at
 * @property int     $updated_at
 * @property string  $password
 * @property string  $full_name
 * @property string  $email
 * @property string  $dial_code
 * @property string  $mobile_number
 * @property string  $profile_photo_path
 * @property string  $email_otp_code
 * @property string  $mobile_otp_code
 * @property string  $address
 * @property boolean $mobile_otp_verified
 * @property boolean $email_otp_verified
 */
class UserSignups extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_signups';

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
        'user_type_id', 'password', 'full_name', 'email', 'dial_code', 'mobile_number', 'profile_photo_path', 'mobile_otp_verified', 'email_otp_verified', 'email_otp_code', 'mobile_otp_code', 'address', 'created_at', 'updated_at'
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
        'user_type_id' => 'int', 'password' => 'string', 'full_name' => 'string', 'email' => 'string', 'dial_code' => 'string', 'mobile_number' => 'string', 'profile_photo_path' => 'string', 'mobile_otp_verified' => 'boolean', 'email_otp_verified' => 'boolean', 'email_otp_code' => 'string', 'mobile_otp_code' => 'string', 'address' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
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
