<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScholarshipPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Scholarship $scholarship)
    {
        return $scholarship->user_id == $user->id;
    }

    public function create(User $user)
    {
        $lastScholarship =  $user->fresh()->lastScholarship;

        if (! $lastScholarship = $user->fresh()->lastScholarship) {
            return true;
        }

        return ! $lastScholarship->wasJustPublished();
    }
}
