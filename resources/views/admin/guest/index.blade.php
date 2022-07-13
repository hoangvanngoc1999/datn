@extends('layout.admin')
@section('main')
<h1>Quản lý thông tin khách hàng</h1>
<div class="container">
    <form action="" class="form-inline">

        <div class="form-group">

            <input class="form-control" name="key" placeholder="Search by name...." value="{{request('key')}}">
        </div>



        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <hr>
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $n=1; ?>
                @foreach($data as $item)
                <tr>
                    <td>{{$n}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        <a href="{{route('guest.destroy', $item->id)}}" class="btn btn-sm btn-danger btndelete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php $n++; ?>
                @endforeach
            </tbody>
        </table>
        <form method="POST" action="" id="form-delete">
            @csrf @method('delete')
        </form>
    </div>
</div>
<hr>
<div>
    {{$data->appends(request()->all())->links()}}
</div>
@stop()
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