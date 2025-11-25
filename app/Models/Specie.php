<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Specie extends Model
{
    use SoftDeletes;

    public function sighting() {
        return $this->hasMany(\App\Models\Sighting::class);
    }
}