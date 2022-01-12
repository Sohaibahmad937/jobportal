<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = [
        'title'
    ];}
