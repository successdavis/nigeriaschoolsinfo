<?php

namespace App;

use App\Schools;
use Illuminate\Database\Eloquent\Model;

class Sponsored extends Model
{
	protected $guarded = [];

	public function schools()
	{
		return $this->hasMany(Schools::class);
	}
}
