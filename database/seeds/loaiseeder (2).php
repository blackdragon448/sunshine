<?php

use Illuminate\Database\Seeder;

class loaiseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list=[];
        $types=["hoa le", "phu lieu","bo hoa","gio hoa", "hoa hop giay", "ke hoa"];
        sort($types);
        
        $today=new DateTime('2018-12-01 15:00:00');
        for ($i=1;$i<=count($types); $i++){
            array_push($list,[
                'l_ma'=>$i,
                'l_ten'=>$types[$i-1],
                'l_taoMoi'=>$today->format('Y-m-d H:i:s'),
                'l_capNhat'=>$today->format('Y-m-d H:i:s')
            ]);
        }
        DB::table('loai')->insert($list);
    }
}
