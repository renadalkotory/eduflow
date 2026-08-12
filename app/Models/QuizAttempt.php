<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttempt extends Model
{
    protected $table = 'quiz_attempts';

    protected $primaryKey = 'attempt_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'quiz_id',
        'score',
        'attempt_date',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'attempt_date' => 'datetime',
        ];
    }

    /**
     * Student who made this attempt.
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
     * Quiz associated with this attempt.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(
            Quiz::class,
            'quiz_id',
            'quiz_id'
        );
    }
}