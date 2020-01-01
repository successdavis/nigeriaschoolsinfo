<?php

namespace App\Filters;

use App\User;

class ExamFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['status', 's'];


    protected function status($status)
    {

        $value = $status === 'open' ? true : false;
        $this->builder->getQuery()->orders = [];
        
        return $this->builder->where('admitting', $value);  
    }

    protected function s($s)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('name', 'LIKE', '%' . $s . '%')
            ->orWhere('short_name', 'LIKE', '%' . $s . '%');
    }

}
