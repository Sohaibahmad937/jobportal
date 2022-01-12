<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience_Levels extends Model
{
    use HasFactory;
    protected $table = 'experience_levels';
    protected $fillable = [
        'from_year',
        'to_year'
    ];
}
