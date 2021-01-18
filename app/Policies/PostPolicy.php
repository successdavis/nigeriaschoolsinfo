<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->hasPermissionTo('create posts');
    }

    public function updateFeaturedImage(User $user, Post $post)
    {
        if ($user->hasRole(['editor', 'admin'])) {
            return true;
        }else if($post->user_id == $user->id && $user->hasPermissionTo('update posts')) {
            
            return true;
        }   
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if ($user->hasRole(['editor', 'admin'])) {
            return true;
        }else if($post->user_id == $user->id && $user->hasPermissionTo('update posts')) {
            
            return true;
        }   
    }
    public function delete(User $user, Post $post)
    {
        return $user->hasPermissionTo('delete posts');
    }

    public function publish(User $user, Post $post)
    {
       return $user->hasPermissionTo('publish posts');
    }

    public function unpublish(User $user, Post $post)
    {
       return $user->hasPermissionTo('unpublish posts');
    }



}
