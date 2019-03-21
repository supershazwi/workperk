<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function companySubPerkDetail() {
        return $this->belongsTo(CompanySubPerkDetail::class);
    }
}
