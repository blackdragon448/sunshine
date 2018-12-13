<!DOCTYPE html>
<html>
<head>
    <title>danh sach san pham</title>
    <neta http-equiv="Content-Type" content="text/html; charset=uft-8"/>
    <style type="text/css">
    *{
        font-family:DejaVu Sans, sans-serif;
    }
    </style>
</head>
<body style="font-size:10px">
    <div class="row">
        <table border="0" align="center" cellpadding="4" style="boder-collapse:collapse;">
            <tr>
                <td colspan="6" align="center" style="font-size:13px;" width="100">
                    <b>Cong ty TNHH ABC</b>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="font-size:13px">
                    <b>http://sunshine.com</b>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="font-size:13px">
                    <b>02920.000.000</b>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="font-size:13px">
                    <img src="{{asset('storage/sunshine_wm64.png')}}"/>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="caption" align="center" style="font-size:13px">
                    <b>danh sach san pham</b>
                </td>
            </tr>
            <tr style="border:1px solid #000">
                <th style="text-align:center">STT</th>
                <th style="text-align:center">hinh san pham</th>
                <th style="text-align:center">ten san pham</th>
                <th style="text-align:center">gia goc</th>
                <th style="text-align:center">gia ban</th>
                <th style="text-align:center">loai san pham</th>
            </tr>
            @foreach($danhsachsanpham as $sp)
            <tr style="border: 1px thin #000">
                 <td align="center" valign="middle" width="5">
                 {{$loop->index+1}}
                </td>
                <td align="center" valign="middle" width="20" height="110">
                     <img class="hinhsanpham" src="{{asset('storage/photos/'.$sp->sp_hinh)}}" width="100" height="100"/>
                </td>
                 <td align="right" valign="middle" width="30">{{$sp->sp_ten}}</td>
                <td align="right" valign="middle" width="15">{{$sp->sp_giaGoc}}</td>
                 <td align="right" valign="middle" width="14">{{$sp->sp_giaBan}}</td>
                @foreach($danhsachloai as $l)
                    @if($sp->l_ma==$l->l_ma)
                    <td align="left" width="15" valign="middle">{{$l->l_ten}}</td>
                    @endif
                 @endforeach
            </tr>
             @endforeach
        </table> 
    </div>
</body>
</html>