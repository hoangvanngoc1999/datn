@extends('layout.fe')
@section('main')
<div class="container">
    <div class="row">
        <h2>Quản lí đơn hàng</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->created_at->format('d-m-Y')}}</td>
                    <td>{{number_format($order->getTotal())}}</td>
                    <td>
                        @if($order->status == 0)
                        <span class="label label-danger">Chưa xác nhận</span>
                        @elseif($order->status == 1)
                        <span class="label label-primary">Đã xác nhận</span>
                        @elseif($order->status == 2)
                        <span class="label label-warning">Đã giao hàng/Thanh toán</span>
                        @else($order->status == 3)
                        <span class="label label-success">Đã hủy</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('home.order.detail', $order->id)}}" class="btn btn-success">Xem</a>
                        <a href="{{route('home.order.detail', $order->id)}}?pdf=true" class="btn btn-danger">Xem
                            PDF</a>
                        <a href="{{route('home.order.detail', $order->id)}}?download=true" class="btn btn-danger">Tải
                            PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop()