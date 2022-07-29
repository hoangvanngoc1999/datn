@extends('layout.admin')
@section('title', 'Add User')
@section('main')

<form action="{{route('user.store')}}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Họ và tên</label>
        <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Nhập email">
        @error('email')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Mật khẩu</label>
        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
        @error('password')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Số điện thoại</label>
        <input type="number" class="form-control" name="phone" placeholder="Nhập số điện thoại">
        @error('phone')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Địa chỉ</label>
        <input type="type" class="form-control" name="address" placeholder="Nhập địa chỉ">
        @error('address')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Chức năng</label>
        <div class="radio">
            <label>
                <input type="radio" name="status" value="1" checked>
                Nhân viên
            </label>
            <label>
                <input type="radio" name="status" value="0">
                Admin
            </label>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
</form>

@endsection