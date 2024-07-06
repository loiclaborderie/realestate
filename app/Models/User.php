<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    protected $attributes = [
        'role' => UserRole::USER,
    ];

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isSeller(): bool
    {
        return $this->role === UserRole::SELLER;
    }

    public function hasRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    public static function createAdmin(array $attributes): self
    {
        $user = self::create($attributes);
        $user->role = UserRole::ADMIN;
        $user->save();
        return $user;
    }

    public static function createSeller(array $attributes): self
    {
        $user = self::create($attributes);
        $user->role = UserRole::SELLER;
        $user->save();
        return $user;
    }

    public function properties() : HasMany
    {
        return $this->hasMany(Property::class);
    }
}
