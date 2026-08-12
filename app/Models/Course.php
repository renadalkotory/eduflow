<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $table = 'courses';

    protected $primaryKey = 'course_id';

    protected $keyType = 'int';

    public $incrementing = true;

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

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'views' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Instructor who created the course.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'instructor_id',
            'user_id'
        );
    }

    /**
     * Category this course belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'category_id'
        );
    }

    /**
     * Sections belonging to the course.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(
            Section::class,
            'course_id',
            'course_id'
        )->orderBy('section_order');
    }
}