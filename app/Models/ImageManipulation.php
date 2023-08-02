<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageManipulation extends Model
{
    use HasFactory;


    const TYPE_RESIZE = 'resize'; // This constant is used in resize() method in ImageManipulationController.php
    const UPDATED_AT = null; // If you don't need `created_at` or `updated_at` columns in your table/model (you can comment out    $table->timestamps();    in the `image_manipulations` table migration. Check 2022_12_07_031053_create_image_manipulations_table.php file), but you'll get this error when INSERTing data into the table/model: "Illuminate\Database\QueryException: SQLSTATE[42S22]: Column not found: 1054 Unknown column &#039;updated_at&#039; in &#039;field list&#039; (SQL: insert into ...". And to avoid this error, define the constant CREATED_AT or UPDATED_AT in the model
    // public $timestamps = false;


    protected $fillable = ['name', 'path', 'type', 'data', 'output_path', 'user_id', 'album_id']; // Mass Assignment: https://laravel.com/docs/9.x/eloquent#mass-assignment
}
