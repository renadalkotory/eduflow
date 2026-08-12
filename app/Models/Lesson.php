<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $primaryKey = 'lesson_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'title',
        'video_url',
        'duration',
        'lesson_order',
    ];

    protected function casts(): array
    {
        return [
            'lesson_order' => 'integer',
        ];
    }

    /**
     * Section this lesson belongs to.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(
            Section::class,
            'section_id',
            'section_id'
        );
    }
}