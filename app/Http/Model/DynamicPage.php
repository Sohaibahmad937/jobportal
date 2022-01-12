<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
    use HasFactory;
    protected $table = 'dynamic_pages';
    
    protected $fillable = [
        'title',
        'description',
        'address',
        'email',
        'phone_number',
        'image_name',
    ];
}
