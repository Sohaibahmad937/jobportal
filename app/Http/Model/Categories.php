<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'category_name'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'parent_id');
    }
}
