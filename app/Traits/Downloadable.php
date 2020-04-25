<?php

namespace App\Traits;

use App\Download;

trait Downloadable
{
    public function downloads ()
    {
        return $this->morphMany(Download::class, 'download');
    }

    public function recordDownload($paymentId, $userId = null)
    {
        return $this->downloads()->save(
            new Download([
                'user_id'       => $userId ?: auth()->id(),
                'payment_id'   => $paymentId
            ])
        );
    }

    // if userId is passed, it should be a user instance not just an id
    public function userDownloads($userId = null)
    {
        // auth()->id()
        $user = $userId ?: auth()->user();
        $payment = $this->getUserPayment();

        if ($payment) {
            return $payment->downloads()->get();
        }
        return null;
    }

    public function userDownloadCounts()
    {
        if ($this->userDownloads() === null) {
            return 0;
        }
        return $this->userDownloads()->count();
    }

    public function downloadsAccessLeft()
    {
        if ($this->userDownloadCounts() < 0) {
            return 0;
        }
        
        return $this->maxDownloadAllowed - $this->userDownloadCounts();
    }

}