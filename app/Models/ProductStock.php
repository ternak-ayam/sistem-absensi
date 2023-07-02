<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_list_id',
        'code',
        'name',
        'stock'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductList::class, 'product_list_id')->onDelete('cascade');
    }
}
