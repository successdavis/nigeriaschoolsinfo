<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolphoto extends Model
{

	protected $fillable = ['url']; 
	
    public function school()
    {
    	return $this->belongsTo('App\Schools', 'schools_id');
    }

    public function getUrlAttribute($photo)
    {
        if ($photo) {
            return asset('storage/' . $photo);
        }else {
            return null;
        }
    }
}
