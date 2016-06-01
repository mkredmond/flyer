<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $table = "flyer_photos";

	protected $fillable = ['photo'];

	/**
	 * A photo may belong to exactly one flyer
	 * 
	 * @return Eloquent relationship
	 */
    public function flyer()
    {
    	return $this->belongsTo(\App\Flyer::class);
    }
}
