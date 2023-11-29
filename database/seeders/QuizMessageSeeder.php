<?php

namespace Database\Seeders;

use App\Models\QuizMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizMessages = [
            ['score_start' => '1','score_end'=>'4','message'=> 'We appreciate your enthusiasm! However, we recommend investing more time in yourself. Enhance your skills with TimesPro.','created_at'=> now(),'updated_at'=> now()],
            ['score_start' => '5','score_end'=>'7','message'=> "You're nearly there! A little extra effort, and you'll be well-prepared in no time. Explore TimesPro programs to become job-ready.",'created_at'=> now(),'updated_at'=> now()],
            ['score_start' => '8','score_end'=>'10','message'=> " Congratulations, you're job-ready! Visit TimesPro to discover programs that can jumpstart your career",'created_at'=> now(),'updated_at'=> now()],
        ];
        QuizMessage::insert($quizMessages);
    }
}
