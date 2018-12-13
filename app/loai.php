<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai extends Model
{
    const CREATED_AT = 'l_taoMoi';
    const UPDATED_AT = 'l_capNhat';
    protected $table='loai';
    protected $fillable=['l_ten', 'l_taoMoi', 'l_capNhat', 'l_trangThai'];
    protected $guarded=['l_ma'];
    protected $primaryKey='l_ma';
    protected $dates=['l_taoMoi', 'l_capNhat'];
    protected $dateFomat='Y-m-d H:i:s';
    public function sanpham()
    {
        return $this->hasMany('App\sanpham', 'l_ma', 'l_ma');
    }

}
