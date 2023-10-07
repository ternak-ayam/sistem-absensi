<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @property PegawaiPresence $presences;
 */

class Presence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAttends(): int
    {
        return $this->presences->whereNotNull('scanned_at')->count();
    }

    public function getNotAttends(): int
    {
        return $this->presences->whereNull('scanned_at')->count();
    }

    public function getLates(): int
    {
        return $this->presences->where('valid_until', '<', now()->format('H:i'))->count();
    }

    public function presences(): HasMany
    {
        return $this->hasMany(PegawaiPresence::class);
    }
}
