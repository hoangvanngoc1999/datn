@extends('layout.admin')
@section('title', 'Add category')
@section('main')

<form action="{{route('category.store')}}" method="POST" role="form">
    @csrf
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Input field">
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