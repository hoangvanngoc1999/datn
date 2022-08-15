@extends('layout.admin')
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
        <div class="form-group" style="color: red">
            <h3>Order note:{{$order->order_note}}</h3>
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
                <td>{{number_format($order->total_price)}}</td>
                <td>
                    <form action="{{route('order.status', $order->id)}}" method="POST" class="form-inline" role="form">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <select name="status" id="input" class="form-control" required="required">
                                <option value="">Chọn trạng thái</option>
                                @if($order->status == 0)
                                <option value="0" {{$order->status == 0 ? 'selected' : ''}}>Chưa xác nhận</option>
                                <option value="1" {{$order->status == 1 ? 'selected' : ''}}>Đã xác nhận</option>
                                <option value="4" {{$order->status == 4 ? 'selected' : ''}}>Đang giao hàng
                                </option>
                                <option value="2" {{$order->status == 2 ? 'selected' : ''}}>Đã giao hàng/Thanh toán
                                </option>
                                <option value="5" {{$order->status == 5 ? 'selected' : ''}}>Đổi hàng
                                </option>
                                <option value="3" {{$order->status == 3 ? 'selected' : ''}}>Đã hủy</option>
                                @elseif($order->status == 1 )
                                <option value="4" {{$order->status == 4 ? 'selected' : ''}}>Đang giao hàng
                                </option>
                                <option value="2" {{$order->status == 2 ? 'selected' : ''}}>Đã giao hàng/Thanh toán
                                </option>
                                <option value="5" {{$order->status == 5 ? 'selected' : ''}}>Đổi hàng
                                </option>
                                <option value="3" {{$order->status == 3 ? 'selected' : ''}}>Đã hủy</option>
                                @elseif($order->status == 2 )

                                <option value="2" {{$order->status == 2 ? 'selected' : ''}}>Đã giao hàng/Thanh toán
                                </option>
                                <option value="5" {{$order->status == 5 ? 'selected' : ''}}>Đổi hàng
                                </option>

                                @elseif($order->status == 3 )

                                <option value="3" {{$order->status == 3 ? 'selected' : ''}}>Đã hủy</option>
                                @elseif($order->status == 4 )

                                <option value="2" {{$order->status == 2 ? 'selected' : ''}}>Đã giao hàng/Thanh toán
                                </option>
                                <option value="5" {{$order->status == 5 ? 'selected' : ''}}>Đổi hàng
                                </option>
                                <option value="3" {{$order->status == 3 ? 'selected' : ''}}>Đã hủy</option>
                                @elseif($order->status == 5 )

                                <option value="5" {{$order->status == 5 ? 'selected' : ''}}>Đổi hàng</option>
                                @endif

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
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
                <th>Số lượng có thể bán</th>
                <th>Hình ảnh</th>
                <th>Số lượng hàng đặt</th>
                <th>Giá</th>
                <th>TT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $item)
            <tr>
                <td>{{$item->product_id}}</td>
                <td>{{$item->prod->name}}</td>
                <td>{{$item->prod->qty}}</td>
                <td>
                    <img src="{{url('/uploads')}}/{{$item->prod->image}}" alt="" width="120">
                </td>
                <td>
                    {{$item->quantity}}
                </td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity * $item->price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
@stop()