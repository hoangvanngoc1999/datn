@extends('layout.fe')
@section('title', 'title')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
@section('main')
<div class="container">
    <div class="col-md-6">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <legend>Đặt lại mật khẩu</legend>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="" class="control-label">Password</label>
                </div>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Input Address">
                    @error('password') <small class="help-block">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="" class="control-label">Confirm Password</label>
                </div>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Input Address">
                    @error('confirm_password') <small class="help-block">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop()