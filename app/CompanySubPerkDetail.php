<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySubPerkDetail extends Model
{
    protected $table = 'company_sub_perk_details';

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function links() {
        return $this->hasMany(Link::class);
    }

    public function cultureImages() {
        return $this->hasMany(CultureImage::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function subPerk() {
        return $this->belongsTo(SubPerk::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
