<div style="width:600px; margin:0 auto;">
    <div style="text-align:center;">
        <h2>Xin chào {{$customer->name}}</h2>
        <p>Email này để giúp bạn lấy lại mật khẩu tài khoản đã bị quên</p>
        <p>Vui lòng click vào link dưới đây để đặt lại mật khẩu</p>
        <p style="color:red;">Chú ý: Mã xác nhận trong link chỉ có hiệu lực trong vòng 30 phút</p>
        <p>
            <a href="{{route('customer.getPass', ['customer' => $customer->id, 'token'=>$customer->token])}}"
                style="display: inline-block; background: green; color:#fff; padding: 7px 25px; font-weight:bold">Đặt
                lại mật khẩu</a>
        </p>
    </div>
</div>