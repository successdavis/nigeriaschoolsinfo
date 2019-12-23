<?php

namespace App\Filters;

use App\User;

class SchoolFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return Builder
     */
    // protected function by($course)
    // {
    //     $user = Schools::where('email', $email)->firstOrFail();

    //     return $this->builder->where('user_id', $user->id);
    // }

    // protected function popular()
    // {
    //     $this->builder->getQuery()->orders = [];
    //     return $this->builder->orderBy('replies_count', 'desc');
    // }
}
