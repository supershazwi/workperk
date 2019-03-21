<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubPerk extends Model
{
    protected $table = 'sub_perks';

    public function perk() {
        return $this->belongsTo(Perk::class);
    }

    public function companies() {
        return $this->belongsToMany(Company::class);
    }

    public function companySubPerkDetail() {
        return $this->hasOne(CompanySubPerkDetail::class);
    }
}
