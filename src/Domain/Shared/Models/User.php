<?php

declare(strict_types=1);

namespace Domain\Shared\Models;

use Database\Factories\UserFactory;
use Domain\Shared\Models\Concerns\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable {
    use HasUuid;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasProfilePhoto;

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        "email",
        'password',
        'theme',
        'profile_photo_path'
    ];
   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(): HasMany  {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'user_id'
        );
    }

    public static function newFactory(): Factory  {
      return new UserFactory();
    }
}
