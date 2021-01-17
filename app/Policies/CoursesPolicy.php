<?php

namespace App\Policies;

use App\Courses;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursesPolicy
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
     * @param  \App\Courses  $courses
     * @return mixed
     */
    public function view(User $user, Courses $courses)
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
        return $user->hasPermissionTo('create courses');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Courses  $courses
     * @return mixed
     */
    public function update(User $user, Courses $courses)
    {
        return $user->hasPermissionTo('update courses');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Courses  $courses
     * @return mixed
     */
    public function delete(User $user, Courses $courses)
    {
        return $user->hasPermissionTo('delete courses');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Courses  $courses
     * @return mixed
     */
    public function restore(User $user, Courses $courses)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Courses  $courses
     * @return mixed
     */
    public function forceDelete(User $user, Courses $courses)
    {
        return false;
    }
}
