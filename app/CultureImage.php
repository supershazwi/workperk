<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CultureImage extends Model
{
    protected $table = 'culture_images';

    public function companySubPerkDetail() {
        return $this->belongsTo(companySubPerkDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
