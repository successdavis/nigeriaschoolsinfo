<?php

namespace App\Traits;

use App\Payment;
use Illuminate\Http\Request;

trait Billable
{
    public function payments ()
    {
        return $this->morphMany(Payment::class, 'billable');
    }

//   get all resources with a payment by this user
    public function scopeWherePaymentBy($query, User $user)
    {
        return $query->whereHas('payments', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }


//  to record payment for a user in a particular module e.g. $course->recordPayment();
//  an extra charge can be passed to a payment
    public function recordPayment($userId = null, $charge = null)
    {
        return $this->payments()->save(
            new Payment([
                'user_id'           => $userId ?: auth()->id(),
                'amount'            => $this->amount + $charge,
                'installmental'     => $installmental ?: true,
                'transaction_ref'   => $trans,
            ])
        );
    }

    public function initializePayment($description)
    {
        $payment = new Payment;
        $payment->transaction_ref  = hexdec(uniqid());
        $payment->description      = $description;
        $payment->amount           = $this->amount;
        $payment->user_id          = auth()->id();

        return $this->payments()->save($payment);
    }

    public function isBilled($userId = null)
    {
        $user = $userId ?: auth()->id();
        return $this->payments()->where('user_id', $user)
                ->where('paid', true)->exists();
    }

    public function getUserPayment($userId = null)
    {
        $user = $userId ?: auth()->id();
        return $this->payments()->where('user_id', $user)
            ->where('paid', true)->orderBy('id','desc')->first();
    }
}