@extends('layout.fe')
@section('main')
<div class="container">
    <h1>Chi tiết đơn hàng online</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>Thông tin khách hàng</h2>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>{{$order->cus->name}}</th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>{{$order->cus->email}}</th>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <th>{{$order->cus->phone}}</th>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <th>{{$order->cus->address}}</th>
                    </tr>
                </thead>
            </table>

        </div>
        <div class="col-md-6">
            <h2>Thông tin người nhận</h2>

            <table class="table table-bordered table-hover">
                <tr>
                    <td>Họ và tên</td>
                    <td>{{$order->name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$order->email}}</td>
                </tr>
                <tr>
                    <td>Điện thoại</td>
                    <td>{{$order->phone}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>{{$order->address}}</td>
                </tr>
            </table>

        </div>
    </div>
    <h3>Thông tin chi tiết đơn hàng</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
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
            </tr>
        </tbody>
    </table>
    <h3>Thông tin chi tiết sản phẩm</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>TT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $item)
            <tr>
                <td>{{$item->product_id}}</td>
                <td>{{$item->prod->name}}</td>
                <td>
                    <img src="{{url('public/uploads')}}/{{$item->prod->image}}" alt="" width="120">
                </td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity * $item->price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
@stop()