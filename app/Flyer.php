<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    /**
     * Fillable fields for a flyer.
     * 
     * @var array
     */
    protected $fillable = [
    	'street',
    	'city',
    	'state', 
    	'country',
    	'zip',
    	'price',
    	'description',
    ];

    /**
     * A flyer contains many photos
     *
     * @return Eloquent relationship
     */

    public function photos()
    {
        return $this->hasMany(\App\Photo::class);
    }
}
