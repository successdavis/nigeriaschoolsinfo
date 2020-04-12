<?php

namespace App\Filters;

use App\Faculty;
use App\User;

class PostFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['q'];
    
    protected function q($q)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('body', 'LIKE', '%' . $q . '%');
    }
}
