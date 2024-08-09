<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'company_id',
        'invoice_number',
        'total_amount',
        'status',
        'date', 
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->invoice_number = 'INV-' . strtoupper(uniqid());
            $invoice->date = now(); 
        });
    }
}

