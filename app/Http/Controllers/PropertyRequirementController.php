<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\PropertyImages;
use App\PropertyVideos;
use App\PropertyRequirement;
use App\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class PropertyRequirementController extends Controller
{
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function remove_requirement(Request $request, PropertyRequirement $propertyRequirement)
    {
		if($propertyRequirement->delete()) {
			return $propertyRequirement;
		}
    }
}