<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoutout extends Model
{
    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function company() {
    	return $this->belongsTo(Company::class);
    }


    public function subPerk() {
    	return $this->belongsTo(SubPerk::class);
    }
}
