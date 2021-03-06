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

        return $this->builder->where(function ($query) use ($s) {
            $query->where('name', 'LIKE', "%{$s}%");
        });
    }
}
