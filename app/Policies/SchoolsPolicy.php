<?php

namespace App\Policies;

use App\Schools;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Schools  $schools
     * @return mixed
     */
    public function view(User $user, Schools $schools)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create schools');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Schools  $schools
     * @return mixed
     */
    public function update(User $user, Schools $schools)
    {
        return $user->hasPermissionTo('update schools');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Schools  $schools
     * @return mixed
     */
    public function delete(User $user, Schools $schools)
    {
        return $user->hasPermissionTo('delete schools');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Schools  $schools
     * @return mixed
     */
    public function restore(User $user, Schools $schools)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Schools  $schools
     * @return mixed
     */
    public function forceDelete(User $user, Schools $schools)
    {
        //
    }
}
