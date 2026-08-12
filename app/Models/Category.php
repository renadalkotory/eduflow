<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'category_name',
        'description',
    ];

    /**
     * Courses belonging to this category.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(
            Course::class,
            'category_id',
            'category_id'
        );
    }
}