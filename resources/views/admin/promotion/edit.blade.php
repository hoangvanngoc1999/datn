@extends('layout.admin')
@section('title', 'Thêm mã khuyến mãi')
@section('main')

<form action="{{route('admin.edit-route-promotion')}}" method="POST" role="form">
    @csrf
    <div class="form-group">
        <label for="">Tên Đợt Khuyến mãi</label>
        <input type="text" class="form-control" name="name" value="{{$promotion['name']}}" placeholder="Input field">
    </div>
    <div class="form-group">
        <label for="">Thời gian khuyến mãi</label>
        <br>
        <label for="">Từ ngày : </label>&emsp;
        <input type="datetime-local" value="{{$promotion['time_start']}}" style="padding-right: 100px;"
            class="form-control" name="dayStart" placeholder="Search by name....">
        <label for="">Đến ngày : </label>&emsp;
        <input type="datetime-local" value="{{$promotion['time_end']}}" style="padding-right: 100px;"
            class="form-control" name="dayEnd" placeholder="Search by name....">
    </div>
    <div class="form-group">
        <label for="">Chọn kiểu : </label>&emsp;
        <select name="type" class="form-control">
            @if($promotion['type'] == '%')
            <option value="1" selected>%</option>
            <option value="2">$</option>
            @else
            <option value="1" selected>%</option>
            <option value="2" selected>$</option>
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="">Cụ thể : </label>&emsp;
        <input type="number" class="form-control" value="{{$promotion['detail']}}" name="detail"
            placeholder="Input field">
    </div>
    <div class="form-group">
        <label for="">Trạng thái</label>

        <div class="radio">
            <label>
                <input type="radio" name="status" value="0" <?= $promotion->status == 0 ? 'checked' : '' ?>>
                Hoạt động
            </label>
            <label>
                <input type="radio" name="status" value="1" <?= $promotion->status == 1 ? 'checked' : '' ?>>
                Tắt
            </label>
        </div>


    </div>

    <input type="hidden" name="id_promotion" value="{{$promotion['id']}}">
    <button type="submit" class="btn btn-primary">Lưu khuyến mãi</button>
</form>

@endsection