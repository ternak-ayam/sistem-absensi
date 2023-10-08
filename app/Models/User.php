<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use App\Models\Traits\HashPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Timedoor\TmdMembership\traits\Fcmable;

/**
 *
 * @mixin
 */

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, Fcmable, HashPassword, HandleUpload;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'state',
        'notes',
        'password',
        'status'
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
    ];

    public function getImageUrl(): string
    {
        return 'https://ui-avatars.com/api/?name=' . $this->name . '&background=ffa426&color=fff';
    }

    public function getAttends(): int
    {
        return $this->presences()->whereNotNull('scanned_at')->count();
    }

    public function getNotAttends(): int
    {
        return $this->presences()->whereNull('scanned_at')->count();
    }

    public function getStatusLabel(): string
    {
        return $this->status ? "Aktif" : "Tidak Aktif";
    }

    public function presences(): HasMany
    {
        return $this->hasMany(PegawaiPresence::class);
    }
}
