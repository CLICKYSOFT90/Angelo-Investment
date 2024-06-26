<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_holder_name',
        'bank_name',
        'routing_number',
        'account_number',
        'iban',
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
    public function bankInfo()
    {
        return $this->belongsTo(BankAccounts::class, 'bank', 'id');
    }
}
