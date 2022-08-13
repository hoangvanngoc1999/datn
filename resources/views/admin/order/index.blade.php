@extends('layout.admin')
@section('main')
<div class="container">
    <form action="" class="form-inline">

        <div class="form-group">
            <input class="form-control" name="key" placeholder="Search by name...." value="{{request('key')}}">
        </div>
        <div class="form-group">
            <select name="order" class="form-control">
                <option value="">Sắp xếp</option>
                <option value="created_at-ASC">Created At ASC</option>
                <option value="created_at-DESC">Created At DESC</option>
                <!-- <option value="amount-ASC">Total Amount ASC</option>
                <option value="amount-DESC">Total Amount DESC</option> -->
            </select>
        </div>
        <div class="form-group">
            <select name="status" class="form-control">
                <option value="">Trạng thái</option>
                <option value="0">Chưa xác nhận</option>
                <option value="1">Đã xác nhận</option>
                <option value="4">Đang giao hàng</option>
                <option value="2">Đã giao hàng/Đã Thanh toán</option>
                <option value="3">Đã Hủy</option>
                <option value="5">Đổi hàng</option>
            </select>
        </div>
        <div class="form-group">
            <label>Date range:</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="text" name="order_by_date" class="form-control float-right" id="reservation">
            </div>
            <!-- /.input group -->
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
                    <td>{{number_format($order->total_price)}}</td>
                    <td>
                        @if($order->status == 0)
                        <span class="label label-danger">Chưa xác nhận</span>
                        @elseif($order->status == 1)
                        <span class="label label-primary">Đã xác nhận</span>
                        @elseif($order->status == 4)
                        <span class="label label-warning">Đang giao hàng</span>
                        @elseif($order->status == 2)
                        <span class="label label-warning">Đã giao hàng/Thanh toán</span>
                        @elseif($order->status == 5)
                        <span class="label label-warning">Đổi hàng</span>
                        @else($order->status == 3)
                        <span class="label label-success">Đã hủy</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.detail', $order->id)}}" class="btn btn-success">Xem</a>
                        <a href="{{route('order.detail', $order->id)}}?pdf=true" class="btn btn-danger">Xem
                            PDF</a>
                        <a href="{{route('order.detail', $order->id)}}?download=true" class="btn btn-danger">Tải
                            PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<form method="POST" action="" id="form-delete">
    @csrf @method('delete')
</form>
<hr>
<div>
    {{$orders->appends(request()->all())->links()}}
</div>
@stop()
@section('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{url('/be')}}/plugins/daterangepicker/daterangepicker.css">
@stop()
@section('js')
<script src="{{url('/be')}}/plugins/moment/moment.min.js"></script>
<script src="{{url('/be')}}/plugins/daterangepicker/daterangepicker.js"></script>
<script>
//Date range picker
$('#reservation').daterangepicker({
    locale: {
        format: 'YYYY/MM/DD',
    }
})
</script>
<script>
$('.btndelete').click(function(ev) {
    ev.preventDefault();
    var _herf = $(this).attr('href');
    $('form#form-delete').attr('action', _herf);
    if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
        $('form#form-delete').submit();
    }



});
</script>
@stop()