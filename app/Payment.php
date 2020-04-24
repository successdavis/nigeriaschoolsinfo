<?php

namespace App;

use App\Download;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Zttp\Zttp;

class Payment extends Model
{
	public $paymentData;

	public function getRouteKeyName()
	{
		return 'transaction_ref';
	}

	public function getPaymentData()
	{
		$result = array();


		$url = 'https://api.paystack.co/transaction/verify/'.$this->transaction_ref;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt(
		  $ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer sk_test_47cd4f3de70abda6bf4350d2344bf02c3dbdcc4d']
		);

		$request = curl_exec($ch);
		curl_close($ch);

		if($request){
		  $result = json_decode($request, true);
		}

		if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
		  	$this->paymentData = $result['data'];
		  	return true;
		}else{
		   	return false;
		}
	}

	public function verifyAmount()
	{
		return $this->paymentData['amount'] == $this->amount;
	}

	public function markSuccessful()
	{
		$this->method 	= $this->paymentData['channel'];
		$this->paid 	= true;
		$this->save();
		return true;
	}

	public function status()
	{
		return !! $this->paid;
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function downloads()
	{
		return $this->hasMany(Download::class);
	}
}
