<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function download(User $user, Project $project)
    {
        if ($project->isBilled() == false) {
            return false;
        }

        // return true;
    }
}
