<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'type',
        'image',
    ];

    const MAKANAN = "MAKANAN";
    const MINUMAN = "MINUMAN";

    public function getType()
    {
        if($this->type == self::MAKANAN) return 'Makanan';
        if($this->type == self::MINUMAN) return 'Minuman';

        return 'Lainnya';
    }
}
