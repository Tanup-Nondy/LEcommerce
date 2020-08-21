<?php

namespace App;

use App\Divisions;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    public function division()
    {
    	return $this->belongsTo(Divisions::class);
    }
}
