<div style="width:600px; margin:0 auto;">
    <div style="text-align:center;">
        <h2>Xin chào {{$auth->name}}</h2>
        <p>Xác nhận thành công</p>
        <p>Cảm ơn bạn đã tin tưởng và mua hàng tại cửa hàng của chúng tôi, chúng tôi sẽ liên hệ với bạn để giao hàng</p>
    </div>
    <h2>Thông tin khách hàng</h2>
    <table border="1" cellspacing="1" cellpadding="10" style="width: 100%">
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
    <table border="1" cellspacing="1" cellpadding="10" style="width: 100%">
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
    <h3>Thông tin chi tiết sản phẩm</h3>
    <table border="1" cellspacing="1" cellpadding="10" style="width: 100%">
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
    <h3>Trạng thái đơn hàng</h3>
    @if($order->status == 0)
    <span class="label label-danger">Chưa xác nhận</span>
    @elseif($order->status == 1)
    <span class="label label-primary">Đã xác nhận</span>
    @elseif($order->status == 2)
    <span class="label label-warning">Đã giao hàng/Thanh toán</span>
    @else($order->status == 3)
    <span class="label label-success">Đã hủy</span>
    @endif
</div>