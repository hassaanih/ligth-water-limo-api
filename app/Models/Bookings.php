<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $mobile_number
 * @property string $email
 * @property int    $tip_for_driver
 * @property int    $created_at
 * @property int    $updated_at
 * @property float  $booking_detail_id
 * @property float  $total_charges
 * @property string $specail_intruction
 */
class Bookings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

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
        'first_name', 'last_name', 'contact_name', 'contact_phone', 'mobile_number', 'email', 'tip_for_driver', 'booking_detail_id', 'created_at', 'updated_at', 'total_charges', 'specail_intructions'
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
        'first_name' => 'string', 'last_name' => 'string', 'contact_name' => 'string', 'contact_phone' => 'string', 'mobile_number' => 'string', 'email' => 'string', 'tip_for_driver' => 'int', 'booking_detail_id' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'total_charges' => 'double', 'specail_intruction' => 'string'
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
    public function details(){
        return $this->hasOne(BookingDetails::class, 'id', 'booking_detail_id');
    }
}
