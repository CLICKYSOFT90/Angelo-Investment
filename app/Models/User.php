<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'username',
        'phone',
        'recieve_digi_updates',
        'accredited_investor',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function userDocs(){
        return $this->hasMany(UserDocs::class, 'users_id', 'id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name.' '.$this->last_name,
        );
    }


    protected function image(): Attribute
    {
        return Attribute::make(
//            get: fn ($value) => !empty($value) ? $value : 'avatar.png',
            get: fn ($value) => asset('profiles'.'/'.(!empty($value) ? $value : 'avatar.png')),
        );
    }
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => asset('profiles'.'/'.(!empty($value) ? $value : 'avatar.png')),
        );
    }
}
