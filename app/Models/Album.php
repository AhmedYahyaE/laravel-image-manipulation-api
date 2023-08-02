<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;



    // Mass Assignment error
    protected $fillable = ['name', 'user_id'];
}
