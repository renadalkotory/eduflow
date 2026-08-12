<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'question',
    ];

    /**
     * Quiz this question belongs to.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(
            Quiz::class,
            'quiz_id',
            'quiz_id'
        );
    }

    /**
     * Answer options for this question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(
            Option::class,
            'question_id',
            'question_id'
        );
    }
}