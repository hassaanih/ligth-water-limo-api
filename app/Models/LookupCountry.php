<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string     $code_alpha2
 * @property string     $name
 * @property int        $code_num
 * @property string     $status
 * @property int        $deleted_at
 * @property int        $created_at
 * @property int        $updated_at
 */

class LookupCountry extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lookup_countries';

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
        'code_alpha2',
        'name',
        'code_num',
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
        'deleted_at', 'created_at'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code_alpha2' => 'string',
        'name' => 'string',
        'code_num' => 'string',
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
        'deleted_at', 'created_at', 'updated_at'
    ];


    /**
     * created Relationship between City and Country
     * A country can have multiple cities
     * therefore hasMany relation
     */
    public function city()
    {
        return $this->hasMany('App\Models\LookupCity');
    }

    /**
     * created Relationship between state and Country
     * A country can have multiple states
     * therefore hasMany relation
     */
    public function states()
    {
        return $this->hasMany('App\Model\LookupState');
    }
}
