<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    public $timestamps = false;

    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'description',
        'thumbnail',
        'price',
        'views',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}