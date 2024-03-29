@extends('layout.fe')
@section('main')

<?php $lang = Session::get('lang');
if (!isset($lang) || $lang == 'vi') {
    $lang = config('langVi');
} else {
    $lang = config('langEn');
} ?>

<section id="cart_items">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <legend>{{$lang['checkout']['checkout1']}}</legend>
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout2']}}</label>
                                <input type="text" class="form-control" name="account_name" placeholder="Input field"
                                    value="{{$account->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout3']}}</label>
                                <input type="text" class="form-control" name="account_email" placeholder="Input field"
                                    value="{{$account->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout4']}}</label>
                                <input type="text" class="form-control" name="account_phone" placeholder="Input field"
                                    value="{{$account->phone}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout5']}}</label>
                                <input type="text" class="form-control" name="account_address" placeholder="Input field"
                                    value="{{$account->address}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <legend>{{$lang['checkout']['checkout6']}}<input type="checkbox" name="" id="is_me"> Is
                                    me</legend>
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout2']}}</label>
                                <input type="text" class="form-control" name="name" placeholder="Input field">
                                @error('name') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout3']}}</label>
                                <input type="email" class="form-control" name="email" placeholder="Input field">
                                @error('email') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout4']}}</label>
                                <input type="number" class="form-control" name="phone" placeholder="Input field">
                                @error('phone') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">{{$lang['checkout']['checkout5']}}</label>
                                <input type="text" class="form-control" name="address" placeholder="Input field">
                                @error('address') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{$lang['checkout']['checkout7']}}</label>
                        <textarea name="order_note" id="input" class="form-control" Placeholder="Order Note"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">{{$lang['checkout']['checkout8']}}</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>{{$lang['cart']['cart5']}}</th>
                                <th>{{$lang['cart']['cart6']}}</th>
                                <th>{{$lang['cart']['cart7']}}</th>
                                <th>{{$lang['cart']['cart8']}}</th>
                                <th>{{$lang['cart']['cart12']}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            @foreach ($carts as $key => $item)

                            <tr>
                                <td>{{$n}}</td>
                                <td><img src="{{url('/uploads')}}/{{$item->image}}" alt="" style="width:50px">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{number_format($item->price * $item->quantity)}}</td>
                            </tr>
                            <?php $n++; ?>
                            @endforeach
                        </tbody>
                    </table>
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
                                    <td><span style="color:green">
                                            {{'-'.$promotion[0]['detail'].$promotion[0]['type']}}</span>
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
                </div>
            </div>
        </div>
    </div>
</section>
@stop()
@section('js')
<script>
$('#is_me').click(function() {
    var isCheck = $(this).is(':checked');
    if (isCheck) {
        var account_name = $('input[name="account_name"]').val();
        var account_email = $('input[name="account_email"]').val();
        var account_phone = $('input[name="account_phone"]').val();
        var account_address = $('input[name="account_address"]').val();

        $('input[name="name"]').val(account_name)
        $('input[name="email"]').val(account_email)
        $('input[name="phone"]').val(account_phone)
        $('input[name="address"]').val(account_address)
    } else {
        $('input[name="name"]').val('')
        $('input[name="email"]').val('')
        $('input[name="phone"]').val('')
        $('input[name="address"]').val('')
    }
})
</script>
@stop()