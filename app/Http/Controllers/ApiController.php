<?php

namespace App\Http\Controllers;

use App\SchoolType;
use Illuminate\Http\Request;

class ApiController extends Controller
{
   public function getSchools(SchoolType $type)
   {
       $getSchools = $type->schools;

       return $getSchools;
   }
}
