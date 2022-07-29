@extends('layout.fe')
@section('main')
<?php $lang = Session::get('lang');
if (!isset($lang) || $lang == 'vi') {
    $lang = config('langVi');
} else {
    $lang = config('langEn');
} ?>
<div class="container">
    <div class="row">
        <h2>{{$lang['order']['order9']}}</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{$lang['cart']['cart16']}}</th>
                    <th>{{$lang['cart']['cart12']}}</th>
                    <th>{{$lang['cart']['cart17']}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
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
                    <td>
                        <a href="{{route('home.order.detail', $order->id)}}" class="btn btn-success">Xem</a>
                        <a href="{{route('home.order.detail', $order->id)}}?pdf=true" class="btn btn-danger">Xem
                            PDF</a>
                        <a href="{{route('home.order.detail', $order->id)}}?download=true" class="btn btn-danger">Tải
                            PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop()