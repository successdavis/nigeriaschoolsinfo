<?php

namespace App;

use App\Post;
use App\Role;
use App\Scholarship;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    public function lastjob()
    {
        return $this->hasOne(Job::class)->latest();
    }

    public function lastScholarship()
    {
        return $this->hasOne(Scholarship::class)->latest();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }

    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
