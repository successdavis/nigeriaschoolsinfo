<?php

namespace App;

use App\Lga;
use App\Schools;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $guarded = [];

    public function lgas()
    {
    	return $this->hasMany(Lga::class);
    }
    public function schools()
    {
    	return $this->hasMany(Schools::class);
    }
}
