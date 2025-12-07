<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'image_path',
    ];

    public function sighting()
    {
        return $this->hasOne(\App\Models\Sighting::class);
    }

}