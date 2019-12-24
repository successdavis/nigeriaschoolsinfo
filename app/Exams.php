<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exams extends Model
{
    use Source;
    use ModelFunctions;

    protected $guarded  = [];
    public $pathPrefix  = '/exams/';
    public $findWith    =   'slug';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($exam) {
            $exam->update(['slug' => $exam->name]);
        });
    }

    public function getRecent()
    {
    	return $this->posts()->limit(20)->get();
    }

    public function getLogoPathAttribute($logo)
    {
        if ($logo) {
            return asset('storage/' . $logo);
        }else {
            return asset('storage/exams/logos/default.jpg');
        }
    }
}
