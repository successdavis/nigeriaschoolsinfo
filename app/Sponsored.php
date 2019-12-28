<?php

namespace App;

use App\Schools;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Sponsored extends Model
{
    use ModelFunctions;
	protected $guarded = [];

    public $findWith    =   'slug';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($sponsored) {
            $sponsored->update(['slug' => $sponsored->name]);
        });
    }

	public function schools()
	{
		return $this->hasMany(Schools::class);
	}
}
