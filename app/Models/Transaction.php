<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'type',
        'amount',
        'status',
        'created_at',
        'updated_at',
    ];

    const STATUS_RADIO = [
        0 => 'Pending',
        1 => 'Completed',
        2 => 'Rejected',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
