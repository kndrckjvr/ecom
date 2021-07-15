<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'user_id', 'service_id', 'date'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusAttribute($status)
    {
        switch ($status) {
            case 1:
                return "Approved";
            case 2:
                return "Paid";
            case 3:
                return "Done";
            case 4:
                return "Deny";
            case 0:
            default:
                return "Checking for Availability";
        }
    }
}
