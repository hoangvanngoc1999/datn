@extends('layout.admin')
@section('title', 'Thêm mã khuyến mãi')
@section('main')

<form action="{{route('admin.create-store-promotion')}}" method="POST" role="form">
    @csrf
    <div class="form-group">
        <label for="">Tên Đợt Khuyến mãi</label>
        <input type="text" class="form-control" name="name" placeholder="Input field">
    </div>
    <div class="form-group">
        <label for="">Thời gian khuyến mãi</label>
        <br>
        <label for="">Từ ngày : </label>&emsp;
        <input type="datetime-local" style="padding-right: 100px;" class="form-control" name="dayStart"
            placeholder="Search by name....">
        <label for="">Đến ngày : </label>&emsp;
        <input type="datetime-local" style="padding-right: 100px;" class="form-control" name="dayEnd"
            placeholder="Search by name....">
    </div>
    <div class="form-group">
        <label for="">Chọn kiểu : </label>&emsp;
        <select name="type" class="form-control">
            <option value="1">%</option>
            <option value="2">$</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Cụ thể : </label>&emsp;
        <input type="number" class="form-control" name="detail" placeholder="Input field">
    </div>

    <button type="submit" class="btn btn-primary">Lưu khuyến mãi</button>
</form>

@endsection