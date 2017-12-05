<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
	* Get the property for the current tenant.
	*/
    public function property()
    {
        return $this->belongsTo('App\Property');
    }

	/**
	* Get the documents for the contact.
	*/
    public function documents()
    {
        return $this->hasMany('App\Files');
    }
}
