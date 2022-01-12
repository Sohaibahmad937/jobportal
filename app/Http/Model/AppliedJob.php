<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    use HasFactory;

  //  protected $table = "AppliedJob";
    protected $fillable = [
        'job_id',
        'user_id',
        'resume'
    ]; 
}
