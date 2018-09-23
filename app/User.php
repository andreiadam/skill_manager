<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function skills()
    {
        return $this->hasMany(UserSkill::class, 'user_id', 'id');
    }

    public static function getLastSkills($id)
    {
        return UserSkill::with('aSkill')
            ->where('user_id', $id)
            ->latest()
            ->get()
            ->unique('skill_id')
            ->toArray();
    }

}
