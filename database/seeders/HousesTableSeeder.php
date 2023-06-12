<?php
/*
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousesTableSeeder extends Seeder
{
    public function run()
    {
        $csv = file_get_contents(storage_path('vite\app\property-data.csv'));
        $rows = array_map('str_getcsv', explode("\n", $csv));
        $header = array_shift($rows);
        $data = [];
        foreach ($rows as $row) {
            $data[] = array_combine($header, $row);
        }
        DB::table('houses')->insert($data);
    }
}*/
