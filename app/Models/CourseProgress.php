<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseProgress extends Model
{
    protected $table = 'course_progress';

    protected $primaryKey = 'progress_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'lesson_id',
        'completed',
        'watched_at',
    ];

    protected function casts(): array
    {
        return [
            'completed' => 'boolean',
            'watched_at' => 'datetime',
        ];
    }

    /**
     * Student who owns this progress record.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'student_id',
            'user_id'
        );
    }

    /**
     * Lesson associated with this progress record.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(
            Lesson::class,
            'lesson_id',
            'lesson_id'
        );
    }
}