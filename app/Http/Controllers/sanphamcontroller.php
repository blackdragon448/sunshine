<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sanpham;
use App\loai;
use Session;
use Storage;
use DB;
use App\hinhanh;
use App\Http\Requests\sanphamrequest;
use App\Exports\sanphamExport;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;

class sanphamcontroller extends Controller
{
   public function index()
   {
       $ds_sanpham=sanpham::all();
       return view('sanpham.index')
       ->with('danhsachsanpham',$ds_sanpham);
   } 
   public function create()
   {
       $ds_loai=loai::all();
       return view('sanpham.create')
       ->with('danhsachloai',$ds_loai);
   }
   public function store(Request $request)
   {
       $validation=$request->validate([
           'sp_hinh'=>'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
           'sp_hinhanhlienquan.*'=>'file|image|mimes:jpeg,png,gif,webp|max:2048'
       ]);
       $sp=new sanpham();
       $sp->sp_ten=$request->sp_ten;
       $sp->sp_giaGoc=$request->sp_giaGoc;
       $sp->sp_giaBan=$request->sp_giBan;
       $sp->sp_thongTin=$request->sp_thongTin;
       $sp->sp_danhGia=$request->sp_danhGia;
       $sp->sp_taoMoi=$request->sp_taoMoi;
       $sp->sp_capNhat=$request->sp_capNhat;
       $sp->sp_trangThai=$request->sp_trangThai;
       $sp->l_ma=$request->l_ma;
       if($request->hasFile('sp_hinh'))
       {
           $file=$request->sp_hinh;
           $sp->sp_hinh=$file->getClientOriginalName();
           $fileSaved=$file->storeAs('public/photos', $sp->sp_hinh);
       }
       $sp->save();
       if($request->hasFile('sp_hinhanhlienquan')){
           $files=$request->sp_hinhanhlienquan;
           foreach($request->sp_hinhanhlienquan as $index=>$file){
               $file->storeAs('public/photos', $file->getClientOriginalName());
               $hinhanh=new hinhanh();
               $hinhanh->sp_ma=$sp->sp_ma;
               $hinhanh->ha_stt=($index+1);
               $hinhanh->ha_ten=$file->getClientOriginalName();
               $hinhanh->save();
           }
       }
       Session::flash('alert-info', 'them moi thanh con');
       return redirect()->route('danhsachsanpham.index');
   }
   public function edit($id)
   {
       $sp=sanpham::where("sp_ma", $id)->first();
       $ds_loai=loai::all();
       return view('sanpham.edit')
       ->with('sp', $sp)->with('danhsachloai',$ds_loai);
   }
   public function update(Request $request, $id)
   {
       $validation=$request->validate([
           'sp_hinh'=>'file|image|mimes:jpeg,gif,png,webp|max:2048',
           'sp_hinhanhlienquan.*'=>'image|mimes:jpeg,png,gif,webp|max:2048'
       ]);
       $sp=sanpham::where("sp_ma", $id)->first();
       $sp->sp_ten=$request->sp_ten;
       $sp->sp_giaGoc=$request->sp_giaGoc;
       $sp->sp_giaBan=$request->sp_giaBan;
       $sp->sp_thongTin=$request->sp_thongTin;
       $sp->sp_danhGia=$request->sp_danhGia;
       $sp->sp_taoMoi=$request->sp_taoMoi;
       $sp->sp_capNhat=$request->sp_capNhat;
       $sp->sp_trangThai=$request->sp_trangThai;
       $sp->l_ma=$request->l_ma;
       if($request->hasFile('sp_hinh'))
       {
           Storage::delete('public/photos/'.$sp->sp_hinh);
           $file=$request->sp_hinh;
           $sp->sp_hinh=$file->getClientOriginalName();
           $fileSave=$file->storeAs('public/photos', $sp->sp_hinh);
       }
       if($request->hasFile('sp_hinhanhlienquan')){
           foreach($sp->hinhanhlienquan()->get() as $hinhanh)
           {
               Storage::delete('public/photos/'.$hinhanh->ha_ten);
               $hinhanh->delete();
           }
           $files=$request->sp_hinhanhlienquan;
           foreach($request->sp_hinhanhlienquan as $index=>$file){
               $file->storeAs('public/photos', $file->getClientOriginalName());
               $hinhanh=new hinhanh();
               $hinhanh->sp_ma=$sp->sp_ma;
               $hinhanh->ha_stt=($index+1);
               $hinhanh->ha_ten=$file->getClientOriginalName();
               $hinhanh->save();
           }
       }
       $sp->save();
       Session::flash('alert-info', 'cap nhat thanh cong');
       return redirect()->route('danhsachsanpham.index');
   }
   public function destroy($id)
   {
       $sp=sanpham::where("sp_ma", $id)->first();
       if(empty($sp)==false)
       {
           foreach($sp->hinhanhlienquan()->get() as $hinhanh)
           {
               Storage::delete('public/photos/'.$hinhanh->ha_ten);
               $hinhanh->delete();
           }
           Storage::delete('public/photos/'.$sp->sp_hinh);
       }
       $sp->delete();
       Session::flash('alert-info', 'xoa san pham thanh cong');
       return redirect()->route('danhsachsanpham.index');
   }
   public function excel()
   {
       $ds_sanpham=sanpham::all();
       $ds_loai=loai::all();
       $data=[
           'danhsachsanpham'=>$ds_sanpham,
           'danhsachloai'=>$ds_loai,
       ];
       return view('sanpham.excel')
       ->with('danhsachsanpham', $ds_sanpham)
       ->with('danhsachloai',$ds_loai);
       return Excel::download(new sanphamExport, 'danhsachsanpham.xlsx');
   }
   public function pdf()
   {
       $ds_sanpham=sanpham::all();
       $ds_loai=loai::all();
       $data=[
           'danhsachsanpham'=>$ds_sanpham,
           'danhsachloai'=>$ds_loai,
       ];
       $pdf=PDF::loadView('sanpham.pdf', $data);
       return $pdf->download('danhmucsanpham.pdf');
   }
   public function print()
   {
       $ds_sanpham=sanpham::all();
       $ds_loai=loai::all();
       $data=[
           'danhsachsanpham'=> $ds_sanpham,
           'danhsachloai'=>$ds_loai,
       ];
       return view('sanpham.print')
       ->with('danhsachsanpham', $ds_sanpham)
       ->with('danhsachloai', $ds_loai);
   }
   public function show()
   {
    $ds_sanpham=sanpham::all();
    $ds_loai=loai::all();
    $data=[
        'danhsachsanpham'=>$ds_sanpham,
        'danhsachloai'=>$ds_loai,
    ];
    return view('sanpham.excel')
    ->with('danhsachsanpham', $ds_sanpham)
    ->with('danhsachloai',$ds_loai);
    return Excel::download(new sanphamExport, 'danhsachsanpham.xlsx');
   }
}
