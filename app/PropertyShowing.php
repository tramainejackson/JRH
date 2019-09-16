<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PropertyShowing extends Model
{
    use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    // protected $fillable = ['default_photo'];
	
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
	 * Get the date for the property showing.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getShowDateAttribute($value)
	{
		$show_date = new Carbon($value);

		return $show_date;
	}

	/**
	 * Get the time for the property showing.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getShowTimeAttribute($value)
	{
		$show_time = new Carbon($value);

		return $show_time;
	}

	/**
	* Get the property for the media object.
	*/
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
