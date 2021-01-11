<?php

namespace App\Filters;

use App\Faculty;
use App\User;
use App\Post;

class PostFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['draft','q','deleted'];
    

    protected function draft($publish)
    {
        $this->builder->getQuery()->wheres = [];
        if ($filterdata = filter_var($publish, FILTER_VALIDATE_BOOLEAN)) {
            return $this->builder->wherePublished(!$filterdata);
        }
    }

    protected function deleted($deleted)
    {
        $this->builder->getQuery()->wheres = [];
        if (filter_var($deleted, FILTER_VALIDATE_BOOLEAN)) {
            return $this->builder->onlyTrashed();
        }
    }

    protected function q($q)
    {
        return $this->builder->where(function ($query) use ($q) {
            $query->where('title', 'LIKE', "%{$q}%")->orWhere('body', 'LIKE', "%{$q}%");
        });
    }   
}
