<?php

namespace App\Policies;

use App\Job;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Job $job)
    {
        return $job->user_id == $user->id;
    }

    public function create(User $user)
    {
        $lastjob =  $user->fresh()->lastjob;

        if (! $lastjob = $user->fresh()->lastjob) {
            return true;
        }

        return ! $lastjob->wasJustPublished();
    }
}
