<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> origin/feature/student-course-grades

class Course extends Model
{
    protected $table = 'courses';
<<<<<<< HEAD
    protected $primaryKey = 'course_id';
=======

    protected $primaryKey = 'course_id';

    protected $keyType = 'int';

    public $incrementing = true;

>>>>>>> origin/feature/student-course-grades
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

<<<<<<< HEAD
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
=======
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'views' => 'integer',
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
>>>>>>> origin/feature/student-course-grades
