<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int        $country_id
 * @property string     $name
 * @property int        $state_id
 * @property string     $status
 * @property int        $deleted_at
 * @property int        $created_at
 * @property int        $updated_at
 */

class LookupCity extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lookup_cities';

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
        'country_id',
        'name',
        'state_id',
        'status',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'country_id' => 'int',
        'name' => 'string',
        'state_id' => 'int',
        'status' => 'string',
        'deleted_at' => 'date:c',
        'created_at' => 'date:c',
        'updated_at' => 'date:c'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * created Relationship between City and Country
     *
     */
    public function country()
    {
        return $this->belongsTo('App\Models\LookupCountry', 'country_id');
    }

    /**
     * created Relationship between city and state 
     *
     */
    public function state()
    {
        return $this->belongsTo('App\Models\LookupState', 'state_id');
    }
}
