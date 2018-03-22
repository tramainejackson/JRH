<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the media for the property.
	*/
    public function medias()
    {
        return $this->hasMany('App\PropertyImages');
    }
	
	/**
	* Get the media for the property.
	*/
    public function videos()
    {
        return $this->hasMany('App\PropertyVideos');
    }
	
	/**
	* Get the contact/tenant for the property.
	*/
    public function tenant()
    {
        return $this->hasOne('App\Contact');
    }
	
	/**
	* Get the documents for the property.
	*/
    public function documents()
    {
        return $this->hasMany('App\Files');
    }
	
	/**
	* Get the documents for the property.
	*/
    public function showings()
    {
        return $this->hasMany('App\PropertyShowing');
    }
}
