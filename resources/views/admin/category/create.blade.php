@extends('layout.admin')
@section('title', 'Add category')
@section('main')

<form action="{{route('category.store')}}" method="POST" role="form">
    @csrf
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Input field">
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