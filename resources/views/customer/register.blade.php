@extends('layout.fe')
@section('title', 'title')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
@section('main')
<div class="container">
    <div class="col-md-6">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <legend>Form register</legend>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="" class="control-label">Name</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Input Name">
                    @error('name') <small class="help-block">{{$message}}</small> @enderror
                </div>
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
                    <label for="" class="control-label">Phone</label>
                </div>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="phone" placeholder="Input Phone">
                    @error('phone') <small class="help-block">{{$message}}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="" class="control-label">Address</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" placeholder="Input Address">
                    @error('address') <small class="help-block">{{$message}}</small> @enderror
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop()