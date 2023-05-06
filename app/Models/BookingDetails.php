<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Date   $pickup_date
 * @property int    $total_stops
 * @property int    $travellers
 * @property int    $kids
 * @property int    $bags
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $vehicle_type_id
 * @property int    $vehicle_id
 * @property int    $baby_chair
 * @property int    $onsight_meetup
 * @property string $pickup_location
 * @property string $drop_location
 * @property float  $total_km
 */
class BookingDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking_details';

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
        'pickup_date', 'pickup_time', 'total_stops', 'pickup_location', 'drop_location', 'travellers', 'kids', 'bags', 'total_km', 'created_at', 'updated_at', 'vehicle_type_id', 'vehicle_id', 'baby_chair', 'onsight_meetup'
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
        'pickup_date' => 'date', 'total_stops' => 'int', 'pickup_location' => 'string', 'drop_location' => 'string', 'travellers' => 'int', 'kids' => 'int', 'bags' => 'int', 'total_km' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'vehicle_type_id' => 'int', 'vehicle_id' => 'int', 'baby_chair' => 'int', 'onsight_meetup' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'pickup_date', 'created_at', 'updated_at'
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
