<?php

namespace App\Filters;

use App\User;

class ProjectFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['s'];

    protected function s($s)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('title', 'LIKE', '%' . $s . '%')
            ->orWhere('description', 'LIKE', '%' . $s . '%');
    }

}
