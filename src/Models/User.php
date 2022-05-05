<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $emailVerifiedAt
 * @property string $password
 * @property Role $role
 * @property string|null $rememberToken
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read Collection<Meetup> $meetups
 * @property-read DatabaseNotificationCollection<DatabaseNotification> $notifications
 * @property-read Collection<SocialAccount> $socialAccounts
 * @property-read Collection<PersonalAccessToken> $tokens
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, MustVerifyEmailContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use MustVerifyEmail;
    use Notifiable;
    use HasFactory;

    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "email",
        "password",
    ];
    protected $attributes = [
        "role" => Role::User,
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];
    protected $casts = [
        "role" => Role::class,
        "email_verified_at" => "datetime",
    ];

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
