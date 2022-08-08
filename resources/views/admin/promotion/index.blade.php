@extends('layout.admin')

@section('title','Category List')
@section('main')


<form action="" class="form-inline">

    <div class="form-group">

        <input class="form-control" name="key" placeholder="Search by name...." value="{{request('key')}}">
    </div>



    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên khuyến mãi</th>
            <th>Thời gian bắt đầu</th>
            <th>Thời gian kết thúc</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
            <th class="text-right">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($promotion as $pro) { ?>
        <tr>
            <td>{{$pro['id']}}</td>
            <td>{{$pro['name']}}</td>
            <td>{{$pro['time_start']}}</td>
            <td>{{$pro['time_end']}}</td>
            <td>{{$pro['created_at']}}</td>
            <td><?= $pro['status'] == 0 ? 'Hoạt động' : 'Đã tắt' ?></td>
            <td style="text-align: right"><a href="{{route('admin.edit-store-promotion',$pro['id'])}}">Xem chi tiết</a>
            </td>
        </tr>

        <?php } ?>
        <!-- // code here -->

    </tbody>
</table>
<form method="POST" action="" id="form-delete">
    @csrf @method('delete')
</form>
<hr>
<div>
    {{$promotion->appends(request()->all())->links()}}
</div>

@endsection
@section('js')

<script>
$('.btndelete').click(function(ev) {
    ev.preventDefault();
    var _herf = $(this).attr('href');
    $('form#form-delete').attr('action', _herf);
    if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
        $('form#form-delete').submit();
    }



});
</script>

@endsection