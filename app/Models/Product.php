<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HandleUpload;

    protected $fillable = [
        'code',
        'name',
        'price',
        'quantity',
        'date',
        'image',
        'type'
    ];

    const MASUK  = "MASUK";
    const KELUAR = "KELUAR";
    const RETURN = "RETURN";

    protected $dates = ['date'];

    public function getType()
    {
        if($this->type == self::MASUK) return 'Barang Masuk';
        if($this->type == self::RETURN) return 'Barang Return';

        return 'Barang Keluar';
    }

    public function imageAttribute(): string
    {
        return 'image';
    }
}
