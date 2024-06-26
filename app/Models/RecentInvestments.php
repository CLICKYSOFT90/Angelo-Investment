<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentInvestments extends Model
{
    use HasFactory;

    public function offering()
    {
        return $this->hasOne(Offerings::class, 'id', 'offering_id');
    }
}
