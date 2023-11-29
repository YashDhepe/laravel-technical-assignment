<?php

namespace Database\Seeders;

use App\Models\VoucherCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    
        $voucherCriteria = [
            ['score_start' => '1','score_end'=>'4','amount'=> '1000','created_at'=> now(),'updated_at'=> now()],
            ['score_start' => '5','score_end'=>'7','amount'=> '2500','created_at'=> now(),'updated_at'=> now()],
            ['score_start' => '8','score_end'=>'10','amount'=> '5000','created_at'=> now(),'updated_at'=> now()],
        ];
        VoucherCriteria::insert($voucherCriteria);
    }
}
