<?php

namespace App\Filters;

use App\Sponsored;
use App\User;

class SchoolFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['q'];

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

    protected function q($sponsored)
    {
        $this->builder->getQuery()->orders = [];
        $sponsored = Sponsored::firstOrFail()->where('slug', $sponsored)->get();
        return $this->builder->where('sponsored_id', $sponsored[0]['id']);
    }
}
