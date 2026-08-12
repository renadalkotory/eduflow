<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $table = 'sections';

    protected $primaryKey = 'section_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'title',
        'section_order',
    ];

    protected function casts(): array
    {
        return [
            'section_order' => 'integer',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(
            Course::class,
            'course_id',
            'course_id'
        );
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(
            Lesson::class,
            'section_id',
            'section_id'
        )->orderBy('lesson_order');
    }

    public function files(): HasMany
    {
        return $this->hasMany(
            CourseFile::class,
            'section_id',
            'section_id'
        );
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(
            Quiz::class,
            'section_id',
            'section_id'
        );
    }
}