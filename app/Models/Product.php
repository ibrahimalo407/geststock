<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'sku', 'quantity', 'tags', 'category_id', 'image'
    ];

    // Automatically generate SKU on product creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->sku = 'SKU-' . strtoupper(Str::random(8));
        });
    }

    // Define relationships
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    protected $casts = [
        'tags' => 'array',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
