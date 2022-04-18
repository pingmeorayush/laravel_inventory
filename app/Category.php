<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;

    protected $guarded = [];

    protected $primaryKey = 'category_id';

    public function parent()
	{
	    return $this->belongsTo(Category::class);
	}

	public function children()
	{
	    return $this->hasMany(Category::class , 'parent_id');
	}

	public function getImage(){
		return url('/')."/images/".$this->image;
	}
}
