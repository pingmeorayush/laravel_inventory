<?php

namespace App\Helpers;

 
class ImageHelper
{
	/**
     * Upload image in the specified path.
     *
     * @param  $data['image']
     * @return image name
     */
	public static function saveImage($data){
	    $file = $data['image'];
        $filename = $file->getClientOriginalName();
        $location = public_path() . "/images/";
        $file->move($location, $filename);
        return $filename;
	}
}