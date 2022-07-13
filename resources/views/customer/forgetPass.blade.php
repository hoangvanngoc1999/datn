@extends('layout.fe')
@section('title', 'title')
@section('main')
<div class="container">
    <div class="col-md-6">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <legend>Lấy lại mật khẩu</legend>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="" class="control-label">Email</label>
                </div>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="Input Email">
                    @error('email') <small class="help-block">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Gửi email xác nhận</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop()