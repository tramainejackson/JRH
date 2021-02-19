<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'email', 'last_name',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Set the user's last name.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setLastNameAttribute($value)
	{
		$this->attributes['last_name'] = ucwords(strtolower($value));
	}

	/**
	 * Set the user's first name.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setFirstNameAttribute($value)
	{
		$this->attributes['first_name'] = ucwords(strtolower($value));
	}

	/**
	 * Set the user's email.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	/**
	 * Get the property for the current tenant.
	 */
	public function property()
	{
		return $this->belongsTo('App\Property');
	}

	/**
	 * Get the contact/tenant for the property.
	 */
	public function image()
	{
		return $this->hasOne('App\ContactImages');
	}

	/**
	 * Concat first and last name
	 */
	public function full_name()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	/**
	 * Search contacts with criteria
	 */
	public function scopeSearch($query, $search)
	{
		return $query->where('first_name', 'like', '%' . $search . '%')
			->orWhere('last_name', 'like', '%' . $search . '%')
			->orWhere('email', 'like', '%' . $search . '%')
			->orWhere('phone', 'like', '%' . $search . '%')
			->get();
	}

	/**
	 * Check for duplicated
	 */
	public function scopeDuplicates($query)
	{
		return $query->selectRaw('*, COUNT(email) as email_count')
			->where('duplicate', null)
			->groupBy('email')
			->havingRaw('COUNT(email) > 1');
	}

	/**
	 * Check for non-duplicates
	 */
	public function scopeNonDuplicates($query)
	{
		return $query->where('duplicate', '<>', 'Y');
	}

}