<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    protected $guarded = [];

    public function deactive()
    {
    	return $this->update([
    		'active' => false,
    		'deactivated_at' => Carbon::now(),
    	]);
    }

    public function activate()
    {
    	return $this->update([
    		'active' => true,
    		'activated_at' => Carbon::now(),
    	]);
    }

    public function status()
    {
    	return !! $this->active;
    }

    public static function activeAdverts()
    {
        return self::whereActive(true)->get();
    }

    public static function inActiveAdverts()
    {
        return self::whereActive(false)->get();
    }
}
