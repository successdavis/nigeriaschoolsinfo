<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Projectcategory extends Model
{
    use ModelFunctions;

    protected $fillable = ['slug'];

    public $pathPrefix  = '/projects-category/';
    public $findWith    =   'slug';
    public $excerpt    =   ['description', 23];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($projectcategory) {
            $projectcategory->update(['slug' => $projectcategory->title]);
        });
    }

    public function projects()
    {
        return $this->hasMany('App\Project','category_id');
    }
}
