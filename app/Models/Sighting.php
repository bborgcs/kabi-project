<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sighting extends Model
{
    public function species() {
        return $this->belongsTo(\App\Models\Species::class);
    }

    public function image() {
        return $this->belongsTo(\App\Models\Image::class);
    }
}