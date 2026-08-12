<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $primaryKey = 'quiz_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'title',
        'total_marks',
    ];

    protected function casts(): array
    {
        return [
            'total_marks' => 'integer',
        ];
    }

    /**
     * Section this quiz belongs to.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(
            Section::class,
            'section_id',
            'section_id'
        );
    }

    /**
     * Questions belonging to this quiz.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(
            Question::class,
            'quiz_id',
            'quiz_id'
        );
    }

    /**
     * Student attempts for this quiz.
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(
            QuizAttempt::class,
            'quiz_id',
            'quiz_id'
        );
    }
}