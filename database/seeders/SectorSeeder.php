<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('sectors')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $sectors = [
            ['name' => 'BFSI','image'=>'images/circle-bfsi.svg','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Logistics, E-commerce & Supply Chain','image'=> 'images/circle-logistics.svg','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Information Technology','image'=> 'images/circle-IT.svg','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Hospitality & Hotel Management','image'=> 'images/circle-hospitality.svg','created_at'=> now(),'updated_at'=> now()],
        ];
        Sector::insert($sectors);
    }
}
