@extends('layout.fe')
@section('main')
<div class="jumbotron">
    <div class="container">
        <h1>Đặt hàng thành công</h1>
        <p>Vui lòng kiểm tra hộp thư của mail và xác nhận đơn hàng. Hệ thống sẽ tự hủy đơn hàng nếu trong vòng 24h bạn
            không xác nhận đơn hàng này </p>
        <p>
            <a href="https://mail.google.com/" class="btn btn-success" target="_blank"><i
                    class="fa fa-google-plus"></i>Mở email của bạn</a>
        </p>
    </div>
</div>
@stop()