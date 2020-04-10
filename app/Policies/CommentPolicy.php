<?php

namespace App\Policies;

use App\User;
use App\comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, comment $comment)
    {
        return $comment->user_id == $user->id;
    }

    // public function create(User $user)
    // {
    //     // $lastcomment =  $user->fresh()->lastcomment;

    //     if (! $lastcomment = $user->fresh()->lastcomment) {
    //         return true;
    //     }

    //     return ! $lastcomment->wasJustPublished();
    // }

}
