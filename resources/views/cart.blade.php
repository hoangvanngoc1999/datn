    @extends('layout.fe')
    @section('main')

    <?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>

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
                        <?php $n=1; ?>
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