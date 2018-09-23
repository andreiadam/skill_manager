<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableSkill extends Model
{
    protected $table = 'available_skills';
    protected $fillable = [
        'skill_name',
    ];
}
