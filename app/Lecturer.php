<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{

    public function readinesses() {
        return $this->hasMany(Readiness::class, 'lecturer_id');
    }
}
