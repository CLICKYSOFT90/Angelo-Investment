<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferingsVideos extends Model
{
    use HasFactory;

    protected $fillable = ['offerings_id', 'video', 'video_name', 'thumbnail'];
}
