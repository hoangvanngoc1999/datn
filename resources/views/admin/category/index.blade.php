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
            <th>Name</th>
            <th>Total product</th>
            <th>Status</th>
            <th>Created Date</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $cat)
        <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->name}}</td>

            <td>{{$cat->products ? $cat->products->count() :0}}</td>
            <td>
                @if($cat->status == 0)
                <span class="badge badge-danger">Private</span>

                @else
                <span class="badge badge-success">Publish</span>
                @endif
            </td>
            <td>{{$cat->created_at->format('m-d-Y')}}</td>
            <td class="text-right">
                <a href="{{route('category.edit', $cat->id)}}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{route('category.destroy', $cat->id)}}" class="btn btn-sm btn-danger btndelete">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form method="POST" action="" id="form-delete">
    @csrf @method('delete')
</form>

<hr>
<div>
    {{$data->appends(request()->all())->links()}}
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