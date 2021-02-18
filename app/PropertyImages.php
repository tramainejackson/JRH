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
	 * Get the image path.
	 */
	public function getPathAttribute($value) {
		if($value !== null) {
			if(file_exists(str_ireplace('public/images', 'storage/images/sm', $value))) {
				$path = str_ireplace('public/images', 'storage/images/sm', $value);
			} else {
				$path = '/images/empty_prop_3.png';
			}
		} else {
			$path = '/images/empty_prop_3.png';
		}

		return $path;
	}

	/**
	 * Get the property for the media object.
	 */
	public function property() {
		return $this->belongsTo('App\Property');
	}

	/**
	 * Get the default image.
	 */
	public function scopeDefault($query) {
		$getImage = $query->where('default_photo', 'Y')->get()->first();

		if($getImage !== null) {

			if(file_exists(str_ireplace('public', 'storage', $getImage->path))) {
				$path = str_ireplace('public/images', 'storage/images/sm', $getImage->path);
			} else {
				$path = '/images/empty_prop_3.png';
			}

		} else {

			$otherImage = $query->first();

			if($otherImage !== null) {
				if(file_exists(str_ireplace('public', 'storage', $otherImage->path))) {
					$path = str_ireplace('public/images', 'storage/images/sm', asset($otherImage->path));
				} else {
					$path = '/images/empty_prop_3.png';
				}
			} else {
				$path = '/images/empty_prop_3.png';
			}
		}

		return $path;
	}
}