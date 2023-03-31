<?php

namespace App\Models;

use App\Models\Traits\HandleUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, HandleUpload;

    protected $fillable = [
        'product_list_id',
        'code',
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
        if($this->type == self::RETURN) return 'Barang Retur';

        return 'Barang Keluar';
    }

    public function imageAttribute(): string
    {
        return 'image';
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductList::class, 'product_list_id');
    }
}
