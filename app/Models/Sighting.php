<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sighting extends Model
{
    protected $fillable = [
    'species_id',
    'common_name',
    'gender',
    'life_status',
    'user_id',
    'image_id',
    'found_location',
    'description',];


    public function species() {
        return $this->belongsTo(\App\Models\Species::class);
    }

    public function image() {
        return $this->belongsTo(\App\Models\Image::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}