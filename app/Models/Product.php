<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'image',
        'label',
        'category',
        'size',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://via.placeholder.com/400';
        }

        if (Str::startsWith($this->image, 'products/')) {
            return asset('storage/' . $this->image);
        }

        return asset('images/' . $this->image);
    }

    public function orderDetails()

    {
        return $this->hasMany(OrderDetail::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
