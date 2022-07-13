<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng - {{$order->cus->name}}</title>
    <style>
    body {
        font-family: "DejaVu Sans";
    }

    table {
        width: 100%;
        border: 1px solid #333;
        border-collapse: collapse;
        margin-bottom: 25px;
    }

    table tr th,
    table tr td {
        border: 1px solid #333;
        padding: 10px;
        box-sizing: border-box;
        text-align: left;
    }
    </style>
</head>

<body>

    <h1>Chi tiết đơn hàng online</h1>

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
</body>

</html>