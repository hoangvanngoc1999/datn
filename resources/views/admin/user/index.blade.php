@extends('layout.admin')
@section('main')
<h2>Quản lý thông tin quản trị</h2>
<div class="container">
    <form action="" class="form-inline">

        <div class="form-group">

            <input class="form-control" name="key" placeholder="Search by name...." value="{{request('key')}}">
        </div>



        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
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
                        @if($item->role == 0)
                        <span class="badge badge-danger">Admin</span>
                        @else
                        <span class="badge badge-success">Nhân viên</span>
                        @endif
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{route('user.destroy', $item->id)}}" class="btn btn-sm btn-danger btndelete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php $n++; ?>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<form method="POST" action="" id="form-delete">
    @csrf @method('delete')
</form>

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