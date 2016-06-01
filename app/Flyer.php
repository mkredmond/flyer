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

    /**
     * Scoped query for retrieving a flyer from a specific zip code and street
     * 
     * @param  Builder $query
     * @param  string  $zip
     * @param  string  $street
     * @return Builder
     */
    public static function locatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        return static::where(compact('zip', 'street'))->firstOrFail();
    }

    /**
     * Automatically convert price to a number format
     * @param  integer  $price 
     * @return string  
     */
    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }

    /**
     * Add a photo to a flyer.
     * @param Photo $photo [description]
     */
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * A flyer belongs to a user.
     * 
     * @return 
     */
    public function owner()
    {       
        return $this->belongsTo(App\User::class, 'user_id');
    }

    /**
     * Determine if the current user owns the flyer.
     * 
     * @param  User   $user
     * @return boolean
     */
    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }
}
