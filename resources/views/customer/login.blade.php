@extends('layout.fe')
@section('title', 'title')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
@section('main')
<div class="container">
    <div class="col-md-6">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <legend>Form Login</legend>
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
                <div class="col-sm-2">
                    <label for="" class="control-label">Password</label>
                </div>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Input Address">
                    @error('password') <small class="help-block">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox col-sm-10 col-sm-offset-2">
                    <div class="col-sm-6">
                        <label>
                            <input type="checkbox" value="1" name="remember">
                            Remember Login
                        </label>
                    </div>
                    <div class="col-sm-6">
                        <p><a href="{{route('customer.forgetPass')}}">Quên mật khẩu</a></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop()