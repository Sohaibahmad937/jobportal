<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_Hours extends Model
{
    use HasFactory;
    protected $table = 'working_hours';
    protected $fillable = [
        'no_of_hours'
    ];
}
