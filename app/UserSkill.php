<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $table = 'user_skill';
    protected $fillable = [
        'user_id', 'skill_id', 'level'
    ];

    public function aSkill() {
        return $this->hasOne(AvailableSkill::class, 'id','skill_id');
    }

}
