<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trip::Create([
            'origin' => 'Pelotas, RS',
            'destination' => 'Porto Alegre, RS',
            'departure_time' => '2026-06-19 08:00:00',
            'arrival_time' => '2026-06-19 12:00:00',
            'vehicle_id' => 1,
            'driver_id' => 1,
        ]);
    }
}
