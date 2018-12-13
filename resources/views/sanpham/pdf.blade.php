<!DOCTYPE html>
<html>
<head>
    <title>danh sach san pham</title>
    <meta htt-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style Type="text/scc">
    *{
        font-family: DejaVu Sans, sans-serif;
    }
    body{
        font-size: 10px;
    }
    table{
        border-collapse:collapse;
    }
    td{
        vertical-align:middle;
    }
    caption{
        font-size: 20px;
        font-weight:bold;
        text-align:center;
    }
    .hinhasnpham{
        width:100px;
        height:100px;
    }
    .companyInfo{
        font-size: 13px;
        font-weight:bold;
        text-align:center;
    }
    .page-break{
        page-break-after:always;
    }
    </style>
</head>
<body>
    <div class="row">
        <table border="0" align="center">
            <tr>
                <td class="companyInfo">
                    Cong ty TNHH ABC<br/>
                    http://congtyabc.com<br/>
                    0923333333<br/>
                    <img src="{{asset('storage/sinshine_wm64.pnp')}}"/>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <?php
        $tongsotrang=cell(count($danhsachsanpham)/5);
        ?>
        <table border="1" align="center" cellpadding="5">
        <caption>danh sach san pham</caption>
        <tr>
            <th colspan="6" align="center">trang 1/ {{$tongsotrang}}</th>
        </tr>
        <tr>
            <th>STT</th>
            <th>hinh san pham</th>
            <th>ten san pham</th>
            <th>gia goc</th>
            <th>gia ban</th>
            <th>loai san pham</th>
        </tr>
        @foreach($danhsachsanpham as $sp)
        <tr>
            <td align="center">{{$loop->index+1}}</td>
            <td align="center">
                <img class="hinhsacnpham" src"{{asset('storage/photos/'.$sp->sp_hinh)}}"/>
            </td>
            <td align="left">{{$sp->sp_ten}}</td>
            <td align="right">{{$sp->sp_giaGoc}}</td>
            <td align="right">{{$sp->sp_giaBan}}</td>
            @foreach ($danhsachloai as $1)
            @if($sp->l_ma==$1->l_ma)
            <td align="left">{{$1->l_ten}}</td>
            @endif
            @endforeach
        </tr>
        @if(($loop->index+1)%5==0)
    </table>
    <div class="page-break"><div>
    <table border="1" align="center" cellpadding="5">
    <tr>
        <th colspan="6" align="center">trang {{1+ floor(($loop->index+1)/5)}}/ {{$tongsotrang}}</th>
    </tr>
    <tr>
        <th>STT</th>
        <th>hinh san pham</th>
        <th>ten san pham</th>
        <th>gia goc</th>
        <th>gia ban</th>
        <th>loai san pham</th>
    </tr>
    @endif
    @endforeach
</table>
</div>
</body>