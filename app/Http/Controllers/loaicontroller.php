<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loai;
use Session;
use DB;
use App\Http\Requests\loairequest;
use Validator;

class loaicontroller extends Controller
{
    public function index()
    {
        $ds_loai=DB::table('loai')->get();
        return view('loai.index')->with('danhsachloai',$ds_loai);
    }
    public function edit($id)
    {
       $loai=loai::where("l_ma", $id)->first();
        return view('loai.edit')->with('loai',$loai);
    }
    public function update(loairequest $request, $id)
    {
        $loai=loai::where("l_ma", $id)->first();
        $loai->l_ten->$request->l_ten;
        $loai->l_taoMoi->$request->l_taoMoi;
        $loai->l_capNhat->$request->l_capNhat;
        $loai->l_trangThai->$request->l_trangThai;
        $loai->seve();
        Session::flash('alert-info','cap nhat thanh cong');
        return redirect()->route('danhsachloai.index');
    }
    public function destroy($id)
    {
        $loai=loai::where("l_ma", $id)->first();
        $loai->delete();
        Session::flash('alert-ganger','xoa du lieu thanh cong');
        return redirect()->route('danhsachloai.index');
    }
}
