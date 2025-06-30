<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ParkingEvent extends Model
{
    protected $fillable = [
        'event_type',
        'event_time'
    ];

    protected $casts = [
        'event_time' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // Get the current status of the parking spot
    public static function getCurrentStatus()
    {
        $lastEvent = self::orderBy('event_time', 'desc')->first();

        if (!$lastEvent) {
            return [
                'occupied' => false,
                'status' => 'available',
                'last_event' => null
            ];
        }

        $occupied = $lastEvent->event_type === 'arrival';

        return [
            'occupied' => $occupied,
            'status' => $occupied ? 'occupied' : 'available',
            'last_event' => $lastEvent
        ];
    }

    // Record a car arrival
    public static function recordArrival()
    {
        return self::create([
            'event_type' => 'arrival',
            'event_time' => Carbon::now()
        ]);
    }

    // Record a car departure
    public static function recordDeparture()
    {
        return self::create([
            'event_type' => 'departure',
            'event_time' => Carbon::now()
        ]);
    }
}
