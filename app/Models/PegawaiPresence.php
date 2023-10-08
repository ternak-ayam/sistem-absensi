<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PegawaiPresence extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['scanned_at'];

    public function getPresenceStatus(): string
    {
        return $this->scanned_at ? 'Hadir' : 'Tidak Hadir';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
