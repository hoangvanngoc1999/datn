@extends('layout.fe')
@section('main')
<div class="container">
    <h1>Cart empty</h1>
    <a href="{{route('home.index')}}" class="btn btn-warning">Continue Shopping</a>
</div>
@stop()