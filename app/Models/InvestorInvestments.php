<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestorInvestments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offering_id',
        'amount_invested',
        'no_of_shares',
        'status',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offerings::class, 'offering_id');
    }
}
