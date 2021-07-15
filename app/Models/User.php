<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const DEFAULT_USERS = [
        // Admins
        [
            'name' => 'Laureen De Guzman',
            'password' => 'admin',
            'email' => 'laudeguzman29@gmail.com',
            'status' => 3,
        ],
        [
            'name' => 'Daphne Clarice Tonog',
            'password' => 'admin',
            'email' => 'daph.clarice21@gmail.com',
            'status' => 3,
        ],
        [
            'name' => 'Jeanina Nepomuceno',
            'password' => 'admin',
            'email' => 'jbernardonepo@gmail.com',
            'status' => 3,
        ],
        [
            'name' => 'Wasada Egada',
            'password' => 'admin',
            'email' => 'ken3@gmail.com',
            'status' => 3,
        ],


        // Booking Users
        [
            'name' => 'Booking User 1',
            'password' => 'booking',
            'email' => 'booking_user_1@gmail.com',
            'status' => 1,
        ],
        [
            'name' => 'Booking User 2',
            'password' => 'booking',
            'email' => 'booking_user_2@gmail.com',
            'status' => 1,
        ],
        [
            'name' => 'Booking User 3',
            'password' => 'booking',
            'email' => 'booking_user_3@gmail.com',
            'status' => 1,
        ],


        // Service Users
        [
            'name' => 'Ace & Hammer Builders',
            'password' => 'service',
            'email' => 'aceandhammerbuilder@gmail.com',
            'status' => 2,
        ],
        [
            'name' => 'Center Circle Design-Build',
            'password' => 'service',
            'email' => 'centercircledesign-build@gmail.com',
            'status' => 2,
        ],
        
        [
            'name' => 'Big Sky Home Repair',
            'password' => 'service',
            'email' => 'bigskyhomerepair@gmail.com',
            'status' => 2,
        ],
        [
            'name' => 'Just Right Home',
            'password' => 'service',
            'email' => 'justrighthome@gmail.com',
            'status' => 2,
        ],
        
        [
            'name' => 'Comfort in Color',
            'password' => 'service',
            'email' => 'comfortincolor@gmail.com',
            'status' => 2,
        ],
        [
            'name' => 'Brush Up My Home',
            'password' => 'service',
            'email' => 'brushupmyhome@gmail.com',
            'status' => 2,
        ],
        
        [
            'name' => 'Life-Home Movers',
            'password' => 'service',
            'email' => 'life-homemovers@gmail.com',
            'status' => 2,
        ],
        [
            'name' => 'Two men and a Truck',
            'password' => 'service',
            'email' => 'twomenandatruck@gmail.com',
            'status' => 2,
        ],
        
        [
            'name' => 'Puso Septic and Plumbing',
            'password' => 'service',
            'email' => 'pusosepticandplumbing@gmail.com',
            'status' => 2,
        ],
        [
            'name' => 'Hardcore Plumber',
            'password' => 'service',
            'email' => 'Hardcoreplumber@gmail.com',
            'status' => 2,
        ],
        
        [
            'name' => 'Lawn Fairy',
            'password' => 'service',
            'email' => 'lawnfairy@gmail.com',
            'status' => 2,
        ],
        [
            'name' => 'Epic Gardening',
            'password' => 'service',
            'email' => 'epicgardening@gmail.com',
            'status' => 2,
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
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

    public $timestamps = true;

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
            case 0:
                return "Inactive";
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
