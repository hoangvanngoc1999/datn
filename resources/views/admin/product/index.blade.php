@extends('layout.admin')

@section('title', 'Product List')
@section('main')


<form action="" class="form-inline">

    <div class="form-group">
        <input class="form-control" name="key" placeholder="Search by name...." value="{{request('key')}}">
    </div>
    <div class="form-group">
        <select name="cat_id" class="form-control">
            <option value="">Chọn danh mục</option>
            @foreach($cats as $cat)
            <?php $selected = $cat->id == request('cat_id') ? 'selected' : ''; ?>
            <option value="{{$cat->id}}" {{$selected}}>{{$cat->name}}</option>
            @endforeach
        </select>
        <!-- <div class="form-group">
            <select name="price" class="form-control">
                <option value="">Sắp xếp</option>
                <option value="price-ASC">Giá từ thấp đến cao</option>
                <option value="price-DESC">Giá từ cao xuống thấp</option>
            </select>
        </div>
        <div class="form-group">
            <select name="name" class="form-control">
                <option value="">Sắp xếp</option>
                <option value="name-ASC">A-Z</option>
                <option value="name-DESC">Z-A</option>
            </select>
        </div> -->
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
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá/Khuyến mãi</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Ảnh</th>
            <th>Số lượng</th>
            <th class="text-right">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $model)
        <tr>
            <td>{{$model->id}}</td>
            <td>{{$model->name}}</td>
            <td>{{$model->cat->name}}</td>
            <td>{{$model->price}}/<span class="badge badge-success">{{$model->sale_price}}</span></td>
            <td>
                @if($model->status == 0)
                <span class="badge badge-danger">Ẩn</span>

                @else
                <span class="badge badge-success">Hiện</span>
                @endif
            </td>
            <td>{{$model->created_at->format('m-d-Y')}}</td>
            <td><img src="{{url('/uploads')}}/{{$model->image}}" width="60"></td>
            <td>{{$model->qty}}</td>
            <td class="text-right">
                <a href="{{route('product.edit', $model->id)}}" class="btn btn-sm btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{route('product.destroy', $model->id)}}" class="btn btn-sm btn-danger btndelete">
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