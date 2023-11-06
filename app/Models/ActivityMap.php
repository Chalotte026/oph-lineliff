<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMap extends Model
{
    use HasFactory;
    protected $fillable = ['id','map_id', 'activity_id','location'];
}
