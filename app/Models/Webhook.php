<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $fillable = ['url', 'event', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
