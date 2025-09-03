<?php

namespace Database\Seeders;

use App\Models\PhotoSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSessionsSeeder extends Seeder
{
    public function run(): void
    {
        $photoSessions = [
            ['code' => 'IS-01', 'name' => 'Indoor Session 01', 'type' => '1', 'start_time' => '11:00:00', 'end_time' => '12:00:00'],
            ['code' => 'IS-02', 'name' => 'Indoor Session 02', 'type' => '1', 'start_time' => '12:00:00', 'end_time' => '13:00:00'],
            ['code' => 'IS-03', 'name' => 'Indoor Session 03', 'type' => '1', 'start_time' => '13:00:00', 'end_time' => '14:00:00'],
            ['code' => 'IS-04', 'name' => 'Indoor Session 04', 'type' => '1', 'start_time' => '14:00:00', 'end_time' => '15:00:00'],
            ['code' => 'IS-05', 'name' => 'Indoor Session 05', 'type' => '1', 'start_time' => '15:00:00', 'end_time' => '16:00:00'],
            ['code' => 'IS-06', 'name' => 'Indoor Session 06', 'type' => '1', 'start_time' => '16:00:00', 'end_time' => '17:00:00'],
            ['code' => 'IS-07', 'name' => 'Indoor Session 07', 'type' => '1', 'start_time' => '18:00:00', 'end_time' => '19:00:00'],
            ['code' => 'IS-08', 'name' => 'Indoor Session 08', 'type' => '1', 'start_time' => '19:00:00', 'end_time' => '20:00:00'],
            ['code' => 'OS-01', 'name' => 'Outdoor Session 01', 'type' => '0', 'start_time' => '11:00:00', 'end_time' => '20:00:00'],
        ];
        
        foreach ($photoSessions as $photoSession) {
            PhotoSession::firstOrCreate(['code' => $photoSession['code'], 'name' => $photoSession['name'], 'type' => $photoSession['type'], 'start_time' => $photoSession['start_time'], 'end_time' => $photoSession['end_time']]);
        }
    }
}
