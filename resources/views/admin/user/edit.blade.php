@extends('layout.admin')
@section('main')
<form action="{{route('user.update',$user->id)}}" method="POST" role="form">
    @csrf @method('PUT')
    <input type="hidden" id="" value="{{$user->id}}">
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" value="{{$user->name}}" class="form-control" name="name" placeholder="Input field">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" value="{{$user->email}}" class="form-control" name="email" placeholder="Input field">
        @error('email')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Save data</button>
</form>
@stop()