<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
        'title',
        'detail',
        'image_name',
        'thumb_image',
        'link'
    ];
}
