<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string     $name
 * @property string     $abbreviation
 * @property int        $country_id
 * @property string     $status
 * @property int        $created_at
 * @property int        $updated_at
 */

class LookupState extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lookup_states';

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
        'name',
        'abbreviation',
        'country_id',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'abbreviation' => 'string',
        'country_id' => 'int',
        'status' => 'string',
        'created_at' => 'date:c',
        'updated_at' => 'date:c'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];


    /**
     * created Relationship between state and Country
     *
     */
    public function country()
    {
        return $this->belongsTo('App\Models\LookupCountry', 'country_id');
    }

    /**
     * created Relationship between state and city
     *
     */
    public function city()
    {
        return $this->hasMany('App\Models\LookupCity');
    }
}
