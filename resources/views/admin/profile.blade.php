@extends('layout.admin')
@section('main')
<div class="container">
    <div class="row">
        <h2>Profile</h2>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">Name:</label>{{Auth::guard('')->user()->name}}
            </div>
            <div class="form-group">
                <label for="">Email:</label>{{Auth::guard('')->user()->email}}
            </div>
            <div class="form-group">
                <label for="">Số điện thoại:</label>{{Auth::guard('')->user()->phone}}
            </div>
            <div class="form-group">
                <label for="">Địa chỉ:</label>{{Auth::guard('')->user()->address}}
            </div>
            <div class="form-group">
                <a href="{{route('user.changepassword', auth::user()->id)}}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@stop()