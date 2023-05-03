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
        'type',
        'status',
        'reasons'
    ];

    const MASUK  = "MASUK";
    const KELUAR = "KELUAR";
    const RETURN = "RETURN";

    const PENDING   = "PENDING";
    const REJECTED  = "REJECTED";
    const APPROVED  = "APPROVED";

    protected $dates = ['date'];

    public function getType()
    {
        if($this->type == self::MASUK) return 'Barang Masuk';
        if($this->type == self::RETURN) return 'Barang Retur';

        return 'Barang Keluar';
    }

    public function isBarangKeluar(): bool
    {
        return $this->type == self::KELUAR;
    }

    public function isBarangMasuk(): bool
    {
        return $this->type == self::MASUK;
    }

    public function isBarangReturn(): bool
    {
        return $this->type == self::RETURN;
    }

    public function getStatus()
    {
        if($this->status == self::PENDING) return 'Menunggu Persetujuan';
        if($this->status == self::REJECTED) return 'Ditolak';

        return 'Disetujui';
    }

    public function getStatusColor()
    {
        if($this->status == self::PENDING) return 'badge badge-warning';
        if($this->status == self::REJECTED) return 'badge badge-danger';

        return 'badge badge-success';
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
