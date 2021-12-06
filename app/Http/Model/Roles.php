<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'createdate'
    ];

}
