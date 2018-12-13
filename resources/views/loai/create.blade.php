@extends('backend.layouts.index')
@section('title')
them moi loai san pham
@endsection
@section('main-content')
<form>
    <div class="form-group">
        <label for="l_ma">ma loai</label>
        <input type="text" class="form-control" id="l_ma" placeholder="ma loai">

    </div>
    <div class="form-control">
    <label for="l_ten">loai ten</label>
        <input type="text" class="form-control" id="l_ten" placeholder="loai ten">
    </div>
</form>
@endsection