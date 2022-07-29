@extends('layout.fe')
@section('main')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
<div class="container">
    <h3>{{$lang['checkout']['checkout9']}}</h3>
</div>
@stop()