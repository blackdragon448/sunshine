<?php

use Illuminate\Database\Seeder;
use Illuminate\PhpVnDataGenerator\VnBase;
use Illuminate\PhpVnDataGenerator\VnFullName;
use Illuminate\PhpVnDataGenerator\VnPersonalInfo;
class sanphamseeder extends Seeder
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
        $faker=Faker\Factory::create('vi_VN');
        $photos=array('hoahong.jpg', 'hoalan.jpg', 'hoatuoi.jpg');
        for($i=1;$i<=30;$i++){
            $today=new DateTime();
            array_push($list,[
                'sp_ten'=>"sp_ten $i",
                'sp_giaGoc'=>$i,
                'sp_giaBan'=>$i,
                'sp_hinh'=>$faker->randomElements($photos)[0],
                'sp_thongTin'=>"sp_thongtin $i",
                'sp_danhGia'=>"sp_danhGian $i",
                'sp_taoMoi'=>$today->format('Y-m-d H:i:s'),
                'sp_capNhat'=>$today->format('Y-m-d H:i:s'),
                'sp_trangThai'=>$i,
                'l_ma'=>$faker->numberBetween(1, 6)
            ]);
        }
        DB::table('sanpham')->insert($list);
    }
}
