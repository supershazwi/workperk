<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public function subPerks() {
        return $this->belongsToMany(SubPerk::class);
    }

    public function perks() {
        return $this->belongsToMany(Perk::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function companySubPerkDetails() {
        return $this->hasMany(CompanySubPerkDetail::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
