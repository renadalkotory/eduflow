<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'short_description',
        'detailed_description',
        'price',
        'thumbnail_path',
        'promo_video_url',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('sort_order');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function totalLessons(): int
    {
        return $this->sections->sum(fn (Section $section) => $section->lessons->count());
    }

    public function totalDurationSeconds(): int
    {
        return $this->sections->sum(fn (Section $section) => $section->lessons->sum('duration_seconds'));
    }
}
