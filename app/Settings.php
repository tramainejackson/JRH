<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Settings extends Model
{
    /**
     * Get the settings counter date.
     *
     * @param  string  $value
     * @return string
    */
    public function getHitCountDateAttribute($value)
    {
		$date = new Carbon($value);
		
        return $date->toFormattedDateString();
    }
}
