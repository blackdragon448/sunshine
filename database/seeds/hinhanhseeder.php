<?php

use Illuminate\Database\Seeder;
use Illuminate\PhpVnDataGenerator\VnBase;
use Illuminate\PhpVnDataGenerator\VnFullName;
use Illuminate\PhpVnDataGenerator\VnPersonalInfo;

class hinhanhseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list=[];
        $uFN=new VnFullName();
        $uPI=new VnPersonalInfo();
        for($i=1;$i<=30;$i++){
            $today=new DateTime();
            array_push($list,[
                'sp_ma'=>$i,
                'ha_stt'=>$i,
                'ha_ten'=>"ha_ten $i"
            ]);
        }
        DB::table('hinhanh')->insert($list);
    }
}
