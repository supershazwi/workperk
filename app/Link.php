<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    public function company_sub_perk_detail() {
        return $this->belongsTo(CompanySubPerkDetail::class);
    }
}
