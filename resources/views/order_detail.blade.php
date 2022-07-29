@extends('layout.fe')
@section('main')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
<div class="container">
    <h1>{{$lang['order']['order1']}}</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>{{$lang['order']['order2']}}</h2>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{$lang['order']['order3']}}</th>
                        <th>{{$order->cus->name}}</th>
                    </tr>
                    <tr>
                        <th>{{$lang['order']['order4']}}</th>
                        <th>{{$order->cus->email}}</th>
                    </tr>
                    <tr>
                        <th>{{$lang['order']['order5']}}</th>
                        <th>{{$order->cus->phone}}</th>
                    </tr>
                    <tr>
                        <th>{{$lang['order']['order6']}}</th>
                        <th>{{$order->cus->address}}</th>
                    </tr>
                </thead>
            </table>

        </div>
        <div class="col-md-6">
            <h2>{{$lang['order']['order7']}}</h2>

            <table class="table table-bordered table-hover">
                <tr>
                    <td>{{$lang['order']['order3']}}</td>
                    <td>{{$order->name}}</td>
                </tr>
                <tr>
                    <td>{{$lang['order']['order4']}}</td>
                    <td>{{$order->email}}</td>
                </tr>
                <tr>
                    <td>{{$lang['order']['order5']}}</td>
                    <td>{{$order->phone}}</td>
                </tr>
                <tr>
                    <td>{{$lang['order']['order6']}}</td>
                    <td>{{$order->address}}</td>
                </tr>
            </table>

        </div>
    </div>
    <h3>{{$lang['order']['order8']}}</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{$lang['cart']['cart16']}}</th>
                <th>{{$lang['cart']['cart12']}}</th>
                <th>{{$lang['cart']['cart17']}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->created_at->format('d-m-Y')}}</td>
                <td>{{number_format($order->getTotal())}}</td>
                <td>
                    @if($order->status == 0)
                    <span class="label label-danger">{{$lang['cart']['cart18']}}</span>
                    @elseif($order->status == 1)
                    <span class="label label-primary">{{$lang['cart']['cart19']}}</span>
                    @elseif($order->status == 2)
                    <span class="label label-warning">{{$lang['cart']['cart20']}}</span>
                    @elseif($order->status == 3)
                    <span class="label label-success">{{$lang['cart']['cart21']}}</span>
                    @elseif($order->status == 4)
                    <span class="label label-info">Đang giao hàng</span>
                    @else($order->status == 5)
                    <span class="label label-warning">Đổi hàng</span>
                    @endif
                </td>   
            </tr>
        </tbody>
    </table>
    <h3>{{$lang['cart']['cart22']}}</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{$lang['cart']['cart6']}}</th>
                <th>{{$lang['cart']['cart5']}}</th>
                <th>{{$lang['cart']['cart7']}}</th>
                <th>{{$lang['cart']['cart8']}}</th>
                <th>{{$lang['cart']['cart9']}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $item)
            <tr>
                <td>{{$item->product_id}}</td>
                <td>{{$item->prod->name}}</td>
                <td>
                    <img src="{{url('/uploads')}}/{{$item->prod->image}}" alt="" width="120">
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