<?php

namespace App\Traits;

use App\comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Commentable
{
    public function comments ()
    {
        return $this->morphMany(comment::class, 'commentable');
    }

    // public function comments()
    // {
    //     return $this->invoices()->save(
    //         new Invoice([
    //             'user_id' => $userId ?: auth()->id(),
    //             'amount' => $this->amount + $charge,
    //             'invoiceNo' => Invoice::generateInvoiceNo(),
    //             'installmental' => $installmental ?: true,
    //         ])
    //     );
    // }
}
