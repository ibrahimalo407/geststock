<?php
// app/Models/Order.php

// app/Models/Order.php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'ordered_at', 'total_amount'];

    // Relation avec Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relation avec Product (via une table pivot si vous avez des produits associés)
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }
}
    
