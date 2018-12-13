@extends('backend.layouts.index')
@section('title')
danh sach loai san pham
@endsection
@section('main-content')
<h1>xin chao</h1>
<div class="flash-message">
    @foreach(['danger','warning','seccess', 'info'] as $msg)
        @if(Session::has('alert-'.$msg))
        <p class="alert alert-{{$msg}}">{{Session::get('alert-'.$msg)}}<a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
<table>
    <thead>
        <tr>
            <th>ma</th>
            <th>ten</th>
            <th>sua</th>
            <th>xoa</th>
        </tr>
    </thead>
    <tbody>
        @foreach($danhsachloai as $loai)
            <tr>
                <td>{{$loai->l_ma}}</td>
                <td>{{$loai->l_ten}}</td>
                <td><a href="{{route('danhsachloai.edit', ['id'=>$loai->l_ma])}}" class="btn btn-danger">sua</td>
                <td>
                    <form method="post" action="{{route('danhsachloai.destroy', ['id'=>$loai->l_ma])}}">
                        <input type="hidden" name="_method" value="DELETE"/>
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger">xoa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection