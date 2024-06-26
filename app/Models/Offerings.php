<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offerings extends Model
{
    use HasFactory;

    public function offeringImages()
    {
        return $this->hasMany(OfferingsImages::class);
    }
    public function offeringVideos()
    {
        return $this->hasMany(OfferingsVideos::class);
    }
    public function offeringRequiredDocuments()
    {
        return $this->hasMany(OfferingsDocuments::class)->where('is_required', 1);
    }
    public function offeringDocuments()
    {
        return $this->hasMany(OfferingsDocuments::class);
    }
    public function offeringInvestments()
    {
        return $this->hasMany(InvestorInvestments::class, 'offering_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($offerings) {
            $offerings->offeringImages->each->delete();
            $offerings->offeringVideos->each->delete();
            $offerings->offeringDocuments->each->delete();
        });

    }
}
