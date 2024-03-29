<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Wnikk\LaravelAccessRules\Traits\HasPermissions;

/**
 * @property int $id
 * @property string $public_id
 * @property string $name
 * @property string $description
 * @property $created_at
 * @property $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasPermissions;
    use HasUuids;

    /**
     * @inheritDoc
     * @return string[]
     */
    public function uniqueIds(): array
    {
        return [
            'public_id',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'public_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
