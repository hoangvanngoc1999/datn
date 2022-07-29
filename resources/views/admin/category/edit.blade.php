@extends('layout.admin')
@section('title', 'edit category')
@section('main')

<form action="{{route('category.update',$category->id)}}" method="POST" role="form">
    @csrf @method('PUT')
    <input type="hidden" id="" value="{{$category->id}}">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" value="{{$category->name}}" class="form-control" name="name" placeholder="Input field">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Trạng thái</label>

        <div class="radio">
            <label>
                <input type="radio" name="status" value="1" checked>
                Hiện
            </label>
            <label>
                <input type="radio" name="status" value="0">
                Ẩn
            </label>
        </div>


    </div>
    <button type="submit" class="btn btn-primary">Lưu danh mục</button>
</form>

@endsection