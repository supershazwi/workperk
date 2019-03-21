<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perk extends Model
{
    protected $table = 'perks';

    public function subPerks() {
        return $this->hasMany(SubPerk::class);
    }

    public function companies() {
        return $this->belongsToMany(Company::class);
    }
}
