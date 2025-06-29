<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingEvent;

class ParkingController extends Controller
{
    /**
     * Get the current status of the parking spot
     */
    public function getCurrentStatus()
    {
        $status = ParkingEvent::getCurrentStatus();
        
        return response()->json([
            'success' => true,
            'data' => $status
        ]);
    }

    /**
     * Record a car arrival
     */
    public function carArrived()
    {
        $currentStatus = ParkingEvent::getCurrentStatus();
        
        if ($currentStatus['occupied']) {
            return response()->json([
                'success' => false,
                'message' => 'Parking spot is already occupied'
            ], 400);
        }

        $event = ParkingEvent::recordArrival();
        
        return response()->json([
            'success' => true,
            'message' => 'Car arrival recorded',
            'data' => $event
        ]);
    }

    /**
     * Record a car departure
     */
    public function carLeft()
    {
        $currentStatus = ParkingEvent::getCurrentStatus();
        
        if (!$currentStatus['occupied']) {
            return response()->json([
                'success' => false,
                'message' => 'Parking spot is already empty'
            ], 400);
        }

        $event = ParkingEvent::recordDeparture();
        
        return response()->json([
            'success' => true,
            'message' => 'Car departure recorded',
            'data' => $event
        ]);
    }

    /**
     * List all parking events (arrivals and departures)
     */
    public function getAllEvents()
    {
        $events = ParkingEvent::orderBy('event_time', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $events,
            'total' => $events->count()
        ]);
    }
}
