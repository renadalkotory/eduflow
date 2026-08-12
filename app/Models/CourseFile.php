<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseFile extends Model
{
    protected $table = 'files';

    protected $primaryKey = 'file_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'title',
        'file_path',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
        ];
    }

    /**
     * Section this file belongs to.
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