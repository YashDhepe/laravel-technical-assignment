<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\QuizMessage;
use App\Models\Sector;
use App\Models\VoucherCriteria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(SectorSeeder::class);
        $this->call(GameSeeder::class);
        $this->call(GameSectorSeeder::class);
        $this->call(QuizQuestionSeeder::class);
        $this->call(VoucherCriteriaSeeder::class);
        $this->call(QuizMessageSeeder::class);
    }
}
