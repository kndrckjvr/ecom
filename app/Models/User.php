<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function currentUserType()
    {
        switch ($this->status) {
            case 1:
                return "Booking User";
            case 2:
                return "Service User";
            case 3:
                return "Administrator";
        }
    }

    public function isActive()
    {
        return $this->status != 0;
    }


    public function isBookingUser()
    {
        return $this->status == 1;
    }

    public function isServiceUser()
    {
        return $this->status == 2;
    }

    public function isAdmin()
    {
        return $this->status == 3;
    }
}
