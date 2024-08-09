<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['type', 'date_generated', 'content', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
    