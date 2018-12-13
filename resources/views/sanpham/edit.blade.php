@extends('backend.layouts.index')
@section('title')
hieu chinh san pham
@endsection
@section('custom-css')
<link href="{{asset('vendor/bootstrap-fileinput/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="{{asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
@endsection
@section('main-content')
@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{route('danhsachsanpham.update',['id'=>$sp->sp_ma])}}" enctype="multipart/form-data">

    <input type="hidden" name="_method" value="PUT"/>
    {{csrf_field()}}
    <div clas="form-group">
        <label for="l_ma">loai san pham</label>
        <select name="l_ma" class="form-control">
            @foreach($danhsachloai as $loai)
                @if($loai->l_ma==$sp->l_ma)
                <option value="{{$loai->l_ma}}" selected>{{$loai->l_ten}}</option>
                @else
                <option value="{{$loai->l_ma}}">{{$loai->l_ten}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="sp_ten">ten san pham</label>
        <input type="text" class="form-control" id="sp_ten" name="sp_ten" value="{{old('sp_ten',$sp->sp_ten)}}">
    </div>
    <div class="form-group">
        <label for="sp_giaGoc">gia goc</label>
        <input type="number" class="form-control" id="sp_giaGoc" name="sp_giaGoc" value="{{old('sp_giaGoc',$sp->sp_giaGoc)}}">
    </div>
    <div class="form-group">
        <label for="sp_giaBan">gia ban</label>
        <input type="number" class="form-control" id="sp_giaBan" name="sp_giaBan" value="{{old('sp_giaBan',$sp->sp_giaBan)}}">
    </div>
    <div class="form-group">
        <div class="file-loading">
            <label>hinh dai dien</label>
            <input type="file" id="sp_hinh" name="sp_hinh">
        </div>
    </div>
    <div class="form-group">
        <label for="sp_thongTin">thong tin</label>
        <input type="text" class="form-control" id="sp_thongTin" name="sp_thongTin" value="{{old('sp_thongTin',$sp->sp_thongTin)}}">
    </div>
    <div class="form-group">
        <label for="sp_danhGia">danh gia</label>
        <input type="text" class="form-control" id="sp_danhGia" name="sp_danhGia" value="{{old('sp_danhGia',$sp->sp_danhGia)}}">
    </div>
    <div class="form-group">
        <label for="sp_taoMoi">ngay tao moi</label>
        <input type="text" class="form-control" id="sp_taoMoi" name="sp_taoMoi" value="{{old('sp_taoMoi',$sp->sp_taoMoi)}}" data-mask-datetime>
    </div>
    <div class="form-group">
        <label for="sp_capNhat">ngay cap nhat</label>
        <input type="text" class="form-control" id="sp_capNhat" name="sp_capNhat" value="{{old('sp_capNhat',$sp->sp_capNhat)}}" data-mask-datetime>
    </div>
    <select name="sp_trangThai">
        <option value="1"{{old('sp_trangThai', $sp->sp_trangThai)==1?"selected" :""}}>khoa</option>
        <option value="2"{{old('sp_trangThai', $sp->sp_trangThai)==2?"selected" :""}}>kha dung</option>
    <div class="form-group">
        <div class="file-loading">
            <label>hinh anh lien qunan san pham</label>
            <input id="sp_hinhanhlienquan" type="file" name="sp_hinhanhlienquan[]" multiple>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">luu</button>
    
</form>
@endsection
@section('custom-scripts')
<script src="{{asset('vendor/bootstrap-fileinput/js/plugins/sortable.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/locales/fr.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/bootstrap-fileinput/themes/fas/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#sp_hinh").fileinput({
            theme:'fas',
            showUpload:false,
            showCaption:false,
            browseClass: "btn btn-primary btn-lg",
            fileType:"any",
            append:false,
            showRemove:false,
            autoReplace:true,
            previewFileIcon:"<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial:false,
            initialPreviewShowDelete:false,
            initialPreviewAsData:true,
            initialPreview:[
                "{{asset('storage/photos/'.$sp->sp_hinh)}}"
            ],
            initialPreviewConfig:[
                {
                    Caption: "{{$sp->sp_hinh}}",
                    size:{{Storage::exists('public/photos/'.$sp->sp_hinh)? Storage::size('public/photos/'.$sp->sp_hinh):0}},
                    width:"120px",
                    url:"{$url}",
                    key:1
                },
            ]
        });
        $("#sp_hinhanhlienquan").fileinput({
            theme:'fas',
            showUpload:false,
            showCaption:false,
            browseClass: "btn btn-primary btn-lg",
            fileType:"any",
            append:false,
            showRemove:false,
            autoReplace:true,
            previewFileIcon:"<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial:false,
            allowedFileExtensions:["jpg", "gif","png","txt"],
            initialPreviewShowDelete:false,
            initialPreviewAsData:true,
            initialPreview:[
                @foreach($sp->hinhanhlienquan()->get() as $hinhanh)
                "{{asset('storage/photos/'.$hinhanh->ha_ten)}}",
                @endforeach
            ],
            initialPreviewConfig:[
                @foreach($sp->hinhanhlienquan()->get() as $index=>$hinhanh)
                {
                    caption:"{{$hinhanh->ha_ten}}",
                    size:{{Storage::exists('public/photos/'.$hinhanh->ha_ten)?Storage::size('public/photos/'.$hinhanh->ha_ten):0}},
                    width:"120px",
                    url:"{$url}",
                    key:{{($index+1)}}
                },
                @endforeach    
            ]
        });
    });
</script>
<script src="{{asset('theme/adminlte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('theme/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('theme/adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script>
$(document).ready(function(){

});
</script>
@endsection