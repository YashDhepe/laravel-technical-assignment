<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('game_sector')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $games = Game::all();

        $games->each(function (Game $game) {
            $sectors = Sector::get();
            $game->sectors()->attach($sectors);
        });
    }
}
