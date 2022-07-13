@extends('layout.admin')
@section('main')
<div class="container">
    <form action="" class="form-inline">

        <div class="form-group">

            <input class="form-control" name="key" placeholder="Search by name...." value="{{request('key')}}">
        </div>



        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <hr>
    <div class="row">
        <h2>Quản lí đơn hàng</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên KH</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
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
                    <td>{{$order->cus->name}}</td>
                    <td>{{$order->cus->email}}</td>
                    <td>{{$order->cus->phone}}</td>
                    <td>{{$order->cus->address}}</td>
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
                        <a href="{{route('order.detail', $order->id)}}" class="btn btn-success">Xem</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop()