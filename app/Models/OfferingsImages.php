<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferingsImages extends Model
{
    use HasFactory;

    protected $fillable = ['offerings_id', 'image', 'image_name'];
}
