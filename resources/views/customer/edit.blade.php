@extends('layout.fe')
<?php $lang = Session::get('lang');
if (!isset($lang) || $lang == 'vi') {
    $lang = config('langVi');
} else {
    $lang = config('langEn');
} ?>
@section('main')
<div class="container">
    <div class="row">
        <form action="{{route('customer.update',$customer->id)}}" method="POST" role="form">
            @csrf @method('PUT')
            <input type="hidden" id="" value="{{$customer->id}}">
            <div class="form-group">
                <label for="">Họ và tên</label>
                <input type="text" value="{{$customer->name}}" class="form-control" name="name"
                    placeholder="Input field">
                @error('name')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" value="{{$customer->email}}" class="form-control" name="email"
                    placeholder="Input field">
                @error('email')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" value="{{$customer->phone}}" class="form-control" name="phone"
                    placeholder="Input field">
                @error('phone')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" value="{{$customer->address}}" class="form-control" name="address"
                    placeholder="Input field">
                @error('address')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Save data</button>
    </form>
</div>
</div>
@stop()