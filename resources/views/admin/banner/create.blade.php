@extends('layout.admin')
@section('title', 'Add banner')
@section('main')

<form action="{{route('banner.store')}}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Input field">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Image</label>
        <input type="file" class="form-control" name="image" placeholder="Input name">
        @error('image')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <input type="text" class="form-control" name="description" placeholder="Input field">
        @error('description')
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