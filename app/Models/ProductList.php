<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductList extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_id',
        'name'
    ];

    public function productStock()
    {
        return $this->hasOne(ProductStock::class, 'code', 'custom_id');
    }
}
