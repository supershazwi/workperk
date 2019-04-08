<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    public function companies() {
        return $this->hasMany(Company::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
