<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;

class HouseSeeder extends Seeder
{
    public function run()
    {
        $file = 'C:\Users\NEXONEON\Documents\prak\vite\app\houses.csv';
        $csv = array_map('str_getcsv', file($file));
        $header = array_shift($csv);

        foreach ($csv as $row) {
            $data = array_combine($header, $row);
            House::create($data);
        }
    }
}