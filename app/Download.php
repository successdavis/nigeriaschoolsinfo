<?php

namespace App;

use App\Payment;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['user_id','payment_id'];


    public function payment()
    {
    	return $this->belongsTo(Payment::class);
    }
}
