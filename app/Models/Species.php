<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Species extends Model
{
    use SoftDeletes;
    
    protected $table = 'species'; 

    protected $fillable = [
    'common_name',
    'scientific_name',
];



    public function sighting() {
        return $this->hasMany(\App\Models\Sighting::class);
    }
}