@extends('layout.admin')

@section('title', 'Product List')
@section('main')


<form action="" class="form-inline">

    <div class="form-group">

        <input class="form-control" name="key" placeholder="Search by name....">
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
            <th>Image</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created Date</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $ban)
        <tr>
            <td>{{$ban->id}}</td>
            <td>{{$ban->name}}</td>
            <td><img src="{{url('public/uploads')}}/{{$ban->image}}" width="60"></td>
            <td>{{$ban->description}}</td>
            <td><span class="text-ellipsis">
                    <?php
               if($ban->status==1){
                ?>
                    <a href="{{URL::to('/unactive-slide/'.$ban->id)}}"><span
                            class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                 }else{
                ?>
                    <a href="{{URL::to('/active-slide/'.$ban->id)}}"><span
                            class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                    <?php
               }
              ?>
                </span></td>
            <td>{{$ban->created_at->format('m-d-Y')}}</td>
            <td class="text-right">
                <a href="{{route('banner.edit', $ban->id)}}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{route('banner.destroy', $ban->id)}}" class="btn btn-sm btn-danger btndelete">
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