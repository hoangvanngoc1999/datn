@extends('layout.admin')
@section('title', 'edit category')
@section('main')

<form action="{{route('category.update',$category->id)}}" method="POST" role="form">
    @csrf @method('PUT')
    <input type="hidden" id="" value="{{$category->id}}">
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" value="{{$category->name}}" class="form-control" name="name" placeholder="Input field">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Status</label>

        <div class="radio">
            <label>
                <input type="radio" name="status" value="1" checked>
                Public
            </label>
            <label>
                <input type="radio" name="status" value="0">
                Private
            </label>
        </div>


    </div>
    <button type="submit" class="btn btn-primary">Save data</button>
</form>

@endsection