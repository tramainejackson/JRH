<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyImages extends Model
{
    use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['default_photo'];
	
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the property for the media object.
	*/
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
