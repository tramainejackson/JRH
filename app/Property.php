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
	public function showings()
	{
		return $this->hasMany('App\PropertyShowing');
	}

	/**
	 * Get the requirements for the property.
	 */
	public function requirements()
	{
		return $this->hasMany('App\PropertyRequirement');
	}

	/**
	 * Search properties with criteria
	 */
	public function scopeSearch($query, $search)
	{
		return $query->where('address', 'like', '%' . $search . '%')
			->orWhere('city', 'like', '%' . $search . '%')
			->orWhere('zip', 'like', '%' . $search . '%')
			->orWhere('title', 'like', '%' . $search . '%')
			->orWhere('description', 'like', '%' . $search . '%')
			->get();
	}

	/**
	 * Get properties that are for sale
	 */
	public function scopeForSale($query) {
		return $query->where([
			['sale', '=', 'sale'],
			['active', '=', 'Y'],
		])->get();
	}

	/**
	 * Get properties that are for rent
	 */
	public function scopeForRent($query) {
		return $query->where([
			['sale', '=', 'rent'],
			['active', '=', 'Y'],
		])->get();
	}
}