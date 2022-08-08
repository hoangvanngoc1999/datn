    @extends('layout.fe')
    @section('main')

    <?php $lang = Session::get('lang');
    if (!isset($lang) || $lang == 'vi') {
        $lang = config('langVi');
    } else {
        $lang = config('langEn');
    } ?>

    <link rel="stylesheet" href="https://cdn.leanhduc.pro.vn/utilities/animation/shake-effect/style.css" />
    <style>
.khuyenmai {
    position: fixed;
    bottom: 50px;
    right: 50px;
    width: 300px;
    height: 150px;
    background-color: #eee;
    background-image: url('https://mir-s3-cdn-cf.behance.net/project_modules/1400/b0a68b86128681.5d909dad4eb86.jpg');
    background-size: 100% 100%;
    background-repeat: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px 10px;
    border-radius: 10px;
}

.khuyenmai p {
    font-weight: 600;
    font-size: 18px;
    color: black;
}
    </style>
    @if($promotion!='false')
    <div class="khuyenmai rung">
        <p>Từ ngày <?= $promotion[0]['time_start'] ?> đến ngày <?= $promotion[0]['time_end'] ?> </p>
        <p>Khuyến mãi lên đến <?= $promotion[0]['detail'] ?> <?= $promotion[0]['type'] ?> mỗi đơn hàng</p>
    </div>
    @endif
    <section id="cart_items">
        <div class="container">
            @if($totalQtt == 0)

            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{$lang['cart']['cart3']}} <a href="{{route('home.index')}}">{{$lang['cart']['cart4']}}</a>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>{{$lang['cart']['cart5']}}</th>
                            <th>{{$lang['cart']['cart6']}}</th>
                            <th>{{$lang['cart']['cart7']}}</th>
                            <th>{{$lang['cart']['cart8']}}</th>
                            <th>{{$lang['cart']['cart9']}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        @foreach ($carts as $key => $item)

                        <tr>
                            <td>{{$n}}</td>
                            <td><img src="{{url('/uploads')}}/{{$item->image}}" alt="" style="width:50px"></td>
                            <td>{{$item->name}}</td>
                            <td>
                                <form action="{{route('cart.update',$item->id)}}" method="get">
                                    <input type="number" name="quantity" min="1" max="10" value="{{$item->quantity}}"
                                        style="width:45px; text-align:center">
                                    <button>{{$lang['cart']['cart10']}}</button>
                                </form>
                            </td>
                            <td>{{number_format($item->price)}}</td>
                            <td>{{number_format($item->price * $item->quantity)}}</td>
                            <td>
                                <a href="{{ route('cart.delete', [ 'id' => $item->id ]) }}"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có muốn xóa không?')">&times;</a>
                            </td>
                        </tr>
                        <?php $n++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{$lang['cart']['cart11']}}</th>
                            <th>{{$lang['cart']['cart12']}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$totalQtt}}</td>
                            <td>{{$totalPrice}}</td>

                        </tr>
                        @if($promotion != 'false')
                        <tr>
                            <td></td>
                            <?php
                            if ($totalQtt > 0) {
                                if ($promotion[0]['type'] == "%") {
                                    $total = $totalPrice - ($totalPrice / 100 * $promotion[0]['detail']);
                                } else {
                                    $total = ((int)$totalPrice - (int)$promotion[0]['detail']);
                                }
                            ?>
                            <td><span style="color:green"> {{'-'.$promotion[0]['detail'].$promotion[0]['type']}}</span>
                                : Sự kiện khuyến mãi </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                {{$total}}
                            </td>
                        </tr>
                        <?php if (Auth::guard('cus')->user()->tich_diem > 1000000 && Auth::guard('cus')->user()->tich_diem < 2000000) {
                                    $giam = 2;
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green">-2% </span>: Thành viên đồng
                            </td>
                        </tr>
                        <?php
                                } elseif (Auth::guard('cus')->user()->tich_diem > 2000000 && Auth::guard('cus')->user()->tich_diem < 3000000) {
                                    $giam = 3;
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green">-3%</span>: Thành viên bạc
                            </td>
                        </tr>
                        <?php
                                } elseif (Auth::guard('cus')->user()->tich_diem > 3000000 && Auth::guard('cus')->user()->tich_diem < 4000000) {
                                    $giam = 5;
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green"> -5% </span>: Thành viên vàng
                            </td>
                        </tr>
                        <?php
                                } elseif (Auth::guard('cus')->user()->tich_diem > 4000000) {
                                    $giam = 8;
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green"> -8%</span> : Thành viên kim cương
                            </td>
                        </tr>
                        <?php
                                } ?>
                        <?php if (Auth::guard('cus')->user()->tich_diem > 1000000) {
                                    $total = $total - ($total / 100 * $giam)
                        ?> <tr>
                            <td></td>
                            <td>
                                {{$total}}
                            </td>
                        </tr>
                        <?php
                                }  ?>
                        <?php
                            } else {
                                $total = $totalPrice; ?>
                        <td>{{$totalPrice}}</td>
                        </tr>
                        <?php }
                    ?>
                        @endif

                        @if(Auth::guard('cus')->user()->tich_diem > 1000000 && $promotion == 'false')
                        <?php if (Auth::guard('cus')->user()->tich_diem > 1000000 && Auth::guard('cus')->user()->tich_diem < 2000000) {
                        $giam = 2;
                    ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green">-2% </span>: Thành viên đồng
                            </td>
                        </tr>
                        <?php
                    } elseif (Auth::guard('cus')->user()->tich_diem > 2000000 && Auth::guard('cus')->user()->tich_diem < 3000000) {
                        $giam = 3;
                    ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green">-3%</span>: Thành viên bạc
                            </td>
                        </tr>
                        <?php
                    } elseif (Auth::guard('cus')->user()->tich_diem > 3000000 && Auth::guard('cus')->user()->tich_diem < 4000000) {
                        $giam = 5;
                    ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green"> -5% </span>: Thành viên vàng
                            </td>
                        </tr>
                        <?php
                    } elseif (Auth::guard('cus')->user()->tich_diem > 4000000) {
                        $giam = 8;
                    ?>
                        <tr>
                            <td></td>
                            <td>
                                <span style="color:green"> -8%</span> : Thành viên kim cương
                            </td>
                        </tr>
                        <?php
                    } ?>
                        <?php if (Auth::guard('cus')->user()->tich_diem > 1000000) {
                        $totalPrice = $totalPrice - ($totalPrice / 100 * $giam)
                    ?> <tr>
                            <td></td>
                            <td>
                                {{$totalPrice}}
                            </td>
                        </tr>
                        <?php
                    }  ?>

                        @endif

                    </tbody>
                </table>

            </div>

            <div class="text-center">
                <a href="{{route('home.index')}}" class="btn btn-warning">{{$lang['cart']['cart13']}}</a>
                <a href="{{route('order.checkout')}}" class="btn btn-success">{{$lang['cart']['cart14']}}</a>
                <a href="{{route('cart.clear')}}" class="btn btn-danger"
                    onclick="return confirm('Bạn đã chắc chưa?')">{{$lang['cart']['cart15']}}</a>
            </div>

        </div>
    </section>
    @stop