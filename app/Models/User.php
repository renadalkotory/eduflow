<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The database table used by the model.
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'user_id';

    /**
     * The primary key is an integer.
     */
    protected $keyType = 'int';

    /**
     * The primary key is auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The users table only has created_at.
     */
    const UPDATED_AT = null;

    /**
     * Fields that can be mass assigned.
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'phone',
        'profile_image',
    ];

    /**
     * Fields hidden from arrays/JSON.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}