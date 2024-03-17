<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Events\UserCreated;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Wnikk\LaravelAccessRules\Traits\HasPermissions;

/**
 * @property int id
 * @property string public_id UUID
 * @property string name
 * @property string email
 * @property Role[] roles
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

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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

    /**
     * @return HasMany
     */
    public function roles(): HasMany
    {
        $query = (new Role())->newUserRelationQuery();
        return $this->newHasMany($query, $this, 'user_owner.original_id', 'id');
    }

    public function jsonSerialize(): mixed
    {
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
