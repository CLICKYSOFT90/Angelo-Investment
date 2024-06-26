<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferingsDocuments extends Model
{
    use HasFactory;

    protected $fillable = ['offerings_id', 'documents', 'document_name', 'is_required'];
}
