@extends('layout.fe')
@section('main')
<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>
<div class="jumbotron">
    <div class="container">
        <h1>{{$lang['status']['status1']}}</h1>
        <p>{{$lang['status']['status2']}}</p>
        <p>
            <a href="https://mail.google.com/" class="btn btn-success" target="_blank"><i
                    class="fa fa-google-plus"></i>{{$lang['status']['status3']}}</a>
        </p>
    </div>
</div>
@stop()