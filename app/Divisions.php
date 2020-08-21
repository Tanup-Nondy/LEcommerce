<?php

namespace App;

use App\Districts;
use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    public function district()
    {
    	return $this->hasMany(Districts::class);
    }
}
