@extends('layout.fe')
@section('main')

<section id="cart_items">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <legend>Account Information</legend>
                            </div>
                            <div class="form-group">
                                <label for="">Account Name</label>
                                <input type="text" class="form-control" name="account_name" placeholder="Input field"
                                    value="{{$account->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Account Email</label>
                                <input type="text" class="form-control" name="account_email" placeholder="Input field"
                                    value="{{$account->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Account Phone</label>
                                <input type="text" class="form-control" name="account_phone" placeholder="Input field"
                                    value="{{$account->phone}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Account Address</label>
                                <input type="text" class="form-control" name="account_address" placeholder="Input field"
                                    value="{{$account->address}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <legend>Cogsignee Information <input type="checkbox" name="" id="is_me"> Is me</legend>
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Input field">
                                @error('name') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Input field">
                                @error('email') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Input field">
                                @error('phone') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Input field">
                                @error('address') <small class="help-block">{{$message}}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Order note</label>
                        <textarea name="order_note" id="input" class="form-control" Placeholder="Order Note"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n=1; ?>
                            @foreach ($carts as $key => $item)

                            <tr>
                                <td>{{$n}}</td>
                                <td><img src="{{url('public/uploads')}}/{{$item->image}}" alt="" style="width:50px">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{number_format($item->price * $item->quantity)}}</td>
                            </tr>
                            <?php $n++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    <div>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$totalQtt}}</td>
                                    <td>{{$totalPrice}}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop()
@section('js')
<script>
$('#is_me').click(function() {
    var isCheck = $(this).is(':checked');
    if (isCheck) {
        var account_name = $('input[name="account_name"]').val();
        var account_email = $('input[name="account_email"]').val();
        var account_phone = $('input[name="account_phone"]').val();
        var account_address = $('input[name="account_address"]').val();

        $('input[name="name"]').val(account_name)
        $('input[name="email"]').val(account_email)
        $('input[name="phone"]').val(account_phone)
        $('input[name="address"]').val(account_address)
    } else {
        $('input[name="name"]').val('')
        $('input[name="email"]').val('')
        $('input[name="phone"]').val('')
        $('input[name="address"]').val('')
    }
})
</script>
@stop()