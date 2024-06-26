<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccounts extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'bank_name', 'acc_holder_name', 'acc_number', 'iban', 'routing_number', 'status'];
}
