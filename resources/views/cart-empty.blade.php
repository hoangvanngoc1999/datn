@extends('layout.fe')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
@section('main')
<div class="container">
    <h1>{{$lang['cart']['cart1']}}</h1>
    <a href="{{route('home.index')}}" class="btn btn-warning">{{$lang['cart']['cart2']}}</a>
</div>
@stop()