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
    protected $filters = ['q', 'a', 's', 'attached', 'notattached', 'type'];

    protected function q($sponsored)
    {
        $this->builder->getQuery()->orders = [];
        if (! Sponsored::where('slug', $sponsored)->exists()) {
            abort(422, 'Bad Request');
        }
        $sponsored = Sponsored::where('slug', $sponsored)->get();
        
        return $this->builder->where('sponsored_id', $sponsored[0]['id']);  
    }

    protected function a($a)
    {
        if ($a !== 'admitting') {
            abort(422, 'Bad Request');
        }
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('admitting', true);
    }

    protected function s($s)
    {

        $this->builder->getQuery()->orders = [];
        return $this->builder->where('name', 'LIKE', '%' . $s . '%')
            ->orWhere('description', 'LIKE', '%' . $s . '%');
            // ->orWhere('short_name', 'LIKE', '%' . $s . '%');
    }

    public function attached($course)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->whereHas('courses', function($q) use ($course) {
            $q->where('courses_id', $course);
        });
    }

    public function notattached($course)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->whereDoesntHave('courses', function($q) use ($course) {
            $q->where('courses_id', $course);
        });
    }

    public function type($type)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('school_type_id', $type);
    }
}
