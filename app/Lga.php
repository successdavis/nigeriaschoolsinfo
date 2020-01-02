<?php

namespace App;

use App\Schools;
use App\States;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    protected $guarded = [];

    public function state()
    {
    	return $this->belongsTo(States::class, 'states_id');
    }

    public function schools()
    {
    	return $this->hasMany(Schools::class);
    }
}
