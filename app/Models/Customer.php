<?php

// app/Models/Customer.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone','address'];

    // Relation avec Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
