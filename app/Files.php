<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Files extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the property for the file.
	*/
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
	
	/**
	* Get the contact for the file.
	*/
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
