<?php

namespace App;

use App\Source;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Postcategory extends Model
{
    use Source;
    use ModelFunctions;

    protected $guarded = [];

    public $pathPrefix  = '/post-category/';
    public $findWith    =   'slug';
    public $excerpt    =   ['description', 23];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($postcategory) {
            $postcategory->update(['slug' => $postcategory->title]);
        });
    }

    public function getRecent()
    {
        return $this->posts()->limit(10)->get();
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
