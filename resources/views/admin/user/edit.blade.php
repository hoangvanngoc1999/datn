@extends('layout.admin')
@section('main')
<form action="{{route('user.update',$user->id)}}" method="POST" role="form">
    @csrf @method('PUT')
    <input type="hidden" id="" value="{{$user->id}}">
    <div class="form-group">
        <label for="">Họ và tên</label>
        <input type="text" value="{{$user->name}}" class="form-control" name="name"
            placeholder="Vui lòng nhập họ và tên">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" value="{{$user->email}}" class="form-control" name="email"
            placeholder="Vui lòng nhập email">
        @error('email')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Số điện thoại</label>
        <input type="number" value="{{$user->phone}}" class="form-control" name="phone"
            placeholder="Vui lòng nhập số điện thoại">
        @error('phone')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Địa chỉ</label>
        <input type="text" value="{{$user->address}}" class="form-control" name="address"
            placeholder="Vui lòng nhập địa chỉ">
        @error('address')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Save data</button>
</form>
@stop()