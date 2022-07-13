@extends('layout.admin')
@section('title', 'Update Product')
@section('main')

<form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <input type="hidden" id="" value="{{$product->id}}">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" value="{{$product->name}}" class="form-control" name="name" placeholder="Input name">
                @error('name')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="text" value="{{$product->qty}}" class="form-control" name="qty" placeholder="Input name">
                @error('qty')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image" placeholder="Input name">
                <img src="{{url('public/uploads')}}/{{$product->image}}" width="60">
                @error('image')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Category</label>

                <select name="category_id" id="input" class="form-control">

                    <option value="{{$product->category_id}}">{{$product->cat->name}}</option>
                    @foreach($cats as $cat)

                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" value="{{$product->price}}" class="form-control" name="price"
                    placeholder="Input name">
                @error('price')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Sale price</label>
                <input type="text" value="{{$product->sale_price}}" class="form-control" name="sale_price"
                    placeholder="Input sale price">
                @error('sale_price')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="">Status</label>

                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" checked>
                        Public
                    </label>
                    <label>
                        <input type="radio" name="status" value="0">
                        Private
                    </label>
                </div>


            </div>

        </div>
    </div>






    <button type="submit" class="btn btn-primary">Save data</button>
</form>



@endsection
@section('css')
<!-- summernote -->
<link rel="stylesheet" href="{{url('public/backend')}}/plugins/summernote/summernote-bs4.min.css">
@stop
@section('js')
<!-- Summernote -->
<script src="{{url('public/backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(function() {
    // Summernote
    $('#content').summernote({
        height: 250,
        placeholder: "Description product"
    })


});
</script>
@stop