@extends('layout.fe')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Thông tin khách hàng</h2>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>{{Auth::guard('cus')->user()->name}}</th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>{{Auth::guard('cus')->user()->email}}</th>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <th>{{Auth::guard('cus')->user()->phone}}</th>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <th>{{Auth::guard('cus')->user()->address}}</th>
                    </tr>
                </thead>
            </table>
            <div class="form-group">
                <a href="{{route('customer.edit', Auth::guard('cus')->user()->id)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
            </div>

        </div>
    </div>
</div>
@stop()