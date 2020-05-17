<?php

namespace App\Filters;

use App\Faculty;
use App\User;

class CourseFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['faculty', 's'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return Builder
     */
    protected function faculty($faculty)
    {
        if (!Faculty::where('slug', $faculty)->exists()) {
            return;
        }
        $faculty = Faculty::where('slug', $faculty)->firstOrFail();

        return $this->builder->where('faculty_id', $faculty->id);
    }

    
    protected function s($s)
    {
        if ($s == null) {
            return [];
        }

        $this->builder->getQuery()->orders = [];
        return $result = $this->builder->where('name', 'LIKE', '%' . $s . '%')
            ->orWhere('description', 'LIKE', '%' . $s . '%');
    }
}
