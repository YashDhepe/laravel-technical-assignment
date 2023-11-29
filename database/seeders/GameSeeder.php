<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
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

        $games = [
            ['title'=> 'Win it in 2 minutes!','type'=>'career_assessment','description'=> 'Unlock your career path through our easy career assessment test and stand to win vouchers of up to Rs <b>5000</b>.','image'=>'images/circle-timer.svg','created_at'=>now(),'updated_at'=> now()],
            ['title'=> 'Are you job ready?','type'=>'job_market_assesment','description'=> 'Know where you stand before you enter the job market through a simple TimesPro AI powered test','image'=>'images/circle-job.svg','created_at'=>now(),'updated_at'=> now()],
        ];
        Game::insert($games);

    }
}
