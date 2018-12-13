<?php
use App\loai;

namespace App\Http\Controllers;
use DB;
use Mail;
use App\Mail\contactMailer;
use Illuminate\Http\Request;
use App\sanpham;

class frontendController extends Controller
{
    public function index(Request $request)
    {
        $ds_top3_newest_loaisanpham=DB::table('loai')
        ->join('sanpham', 'loai.l_ma', '=', 'sanpham.l_ma')
        ->orderBy('l_capNhat')->take(3)->get();
        $danhsachsanpham=$this->searchsanpham($request);
        return view('frontend.index')
        ->with('ds_top3_newest_loaisanpham', $ds_top3_newest_loaisanpham)
        ->with('danhsachsanpham', $danhsachsanpham);
    }
    private function searchsanpham(Request $request)
    {
        $query=DB::table('sanpham')->select('*');
        $searchByloaima=$request->query('searchByloaima');
        if($searchByloaima !=null)
        {
            $query->where('l_ma', $seachByloaima);
        }
        $data=$query->get();
        return $data;
    }
    public function about()
    {
        return view('frontend.pages.about');
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function sendmailContactform(Request $request)
    {
        $input=$request->all();
        Mail::to('tester.agmk@gmail.com')
        ->send(new contactMailer($input));
        return $input;
    }
}
