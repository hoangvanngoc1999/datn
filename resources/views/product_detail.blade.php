@extends('layout.fe')
@section('main')

<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>

<link rel="stylesheet" href="https://cdn.leanhduc.pro.vn/utilities/animation/shake-effect/style.css"/>
<style>
    .khuyenmai {
        position: fixed;
        bottom: 50px;
        right: 50px;
        width: 300px;
        height: 150px;
        background-color: #eee;
        background-image: url('https://mir-s3-cdn-cf.behance.net/project_modules/1400/b0a68b86128681.5d909dad4eb86.jpg');
        background-size: 100% 100%;
        background-repeat: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px 10px;
        border-radius: 10px;
    }
    .khuyenmai p {
        font-weight: 600;
        font-size: 18px;
        color: black;
    }
</style>
@if($promotion!='false')
<div class="khuyenmai rung" >
<p>Từ ngày <?= $promotion[0]['time_start'] ?> đến ngày <?= $promotion[0]['time_end'] ?> </p>
<p>Khuyến mãi lên đến <?= $promotion[0]['detail'] ?> <?= $promotion[0]['type'] ?> mỗi đơn hàng</p>
</div>
@endif

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>{{$lang['title']['category']}}</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach($category as $cat)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a
                                        href="{{route('category',['id'=>$cat->id])}}">{{$cat->name}}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/category-products-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="{{url('/fe')}}/images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{url('/uploads/'.$pro->image)}}" alt="" />
                            <h3>ZOOM</h3>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information">
                            <!--/product-information-->
                            <!-- <img src="{{url('/fe')}}/images/product-details/new.jpg" class="newarrival" alt="" /> -->
                            <h2>{{$pro->name}}</h2>

                            <h2>
                                Số lượng:@if($pro->qty == 0)
                                <span class="label label-danger"
                                    style="padding-top: 5px;">{{$lang['product']['product1']}}</span>
                                @else
                                <span class="label label-success" style="padding-top: 5px;">{{$pro->qty}}</span>
                                @endif
                            </h2>
                            <form action="" method="POST">
                                <span>
                                    @if($pro->sale_price > 0)
                                    <span><s>{{'₫'.number_format($pro->price)}}</s> -
                                        <b>{{'₫'.number_format($pro->sale_price)}}</b></span>
                                    @else
                                    <span><b>{{'₫'.number_format($pro->price)}}</b></span>
                                    @endif
                                    <a href="{{route('cart.add',$pro->id)}}" class="btn btn-default cart"><i
                                            class="fa fa-shopping-cart"></i> {{$lang['product']['product2']}}</a>
                                </span>
                            </form>
                            @if(auth()->guard('cus')->check())
                            <div id="rateYo"></div>
                            <form action="{{route('customer.rating')}}" method="POST" class="form-inline"
                                id="formRating">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="rating_start" id="rating_start">
                                    <input type="hidden" class="form-control" name="product_id" value="{{$pro->id}}">
                                    <input type="hidden" class="form-control" name="customer_id"
                                        value="{{auth()->guard('cus')->user()->id}}">
                                </div>
                            </form>
                            @else
                            <div id="rateYo1"></div>
                            @endif
                            <p><b>{{$lang['product']['product3']}}:</b> {{$lang['product']['product4']}}</p>
                            <p><b>{{$lang['product']['product5']}}:</b> {{$lang['product']['product6']}}</p>
                            <p><b>{{$lang['product']['product7']}}:</b> E-SHOPPER</p>
                            <a href=""><img src="{{url('/fe')}}/images/product-details/share.png"
                                    class="share img-responsive" alt="" /></a>
                        </div>
                        <!--/product-information-->
                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#reviews"
                                    data-toggle="tab">{{$lang['product']['product10']}}</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details">
                        </div>

                        <div class="tab-pane fade" id="companyprofile">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{url('/fe')}}/images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <h4>{{$lang['product']['product11']}}</h4>
                                @if(Auth::guard('cus')->check())
                                <form action="" method="post" role="form">
                                    <legend> Xin chào {{Auth::guard('cus')->user()->name}}</legend>
                                    <div class="form-group">
                                        <label for="">{{$lang['product']['product12']}}</label>
                                        <input type="hidden" value="{{$pro->id}}" name="product_id">
                                        <textarea id="comment-comment" name="comment" class="form-control" rows="1"
                                            placeholder="Nhập nội dung"></textarea>
                                        <small id="comment-error" class="help-block"></small>
                                    </div>
                                    <button type="button" class="btn btn-default" id="btn-comment">
                                        {{$lang['product']['product13']}}
                                    </button>
                                </form>
                                @else
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#modelId">{{$lang['product']['product14']}}</button>
                                @endif
                                <h3>Các bình luận</h3>

                                <div id="comment">
                                    @include('list-comment', ['comments'=>$pro->comments])
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng nhập ngay</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error"></div>
                <form action="" method="POST" role="form">

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Input field">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" id="btn-login">Đăng nhập</button>
                </form>

            </div>
        </div>
    </div>
</div>

@stop()
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@stop()
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
//Make sure that the dom is ready
$(function() {
    let ratingavg = '{{$ratingavg}}';
    if (ratingavg == "") {
        ratingavg = 0;
    }
    $("#rateYo").rateYo({
        rating: ratingavg,
        normalFill: "#A0A0A0",
        ratedFill: "#E74C3C",
        starWidth: "20px"
    }).on("rateyo.set", function(e, data) {
        $('#rating_start').val(data.rating);
        $('#formRating').submit();
    });
    $("#rateYo1").rateYo({
        rating: ratingavg,
        normalFill: "#A0A0A0",
        ratedFill: "#E74C3C",
        starWidth: "20px"
    }).on("rateyo.set", function(e, data) {
        alert('Bạn chưa đăng nhập, vui lòng đăng nhập để đánh giá')
    });
});

$('#btn-login').click(function(ev) {
    ev.preventDefault();
    var _csrf = '{{csrf_token()}}';
    var _loginUrl = '{{route("ajax.login")}}';
    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
        url: _loginUrl,
        type: 'POST',
        data: {
            email: email,
            password: password,
            _token: _csrf
        },
        success: function(res) {
            if (res.error) {
                console.log(res);
                let _html_error =
                    '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                for (let error of res.error) {
                    _html_error += `<li>${error}</li>`;
                }
                _html_error += '</div>';
                $('#error').html(_html_error);
            } else {
                alert('Đăng nhập thành công');
                location.reload();
            }
        }
    });
});

let _commentUrl = '{{route("ajax.comment", $pro->id)}}';
$('#btn-comment').click(function(ev) {
    ev.preventDefault();
    var _csrf = '{{csrf_token()}}';
    let comment = $('#comment-comment').val();

    $.ajax({
        url: _commentUrl,
        type: 'POST',
        data: {
            comment: comment,
            _token: _csrf
        },
        success: function(res) {
            if (res.error) {
                $('#comment-error').html(res.error);
            } else {
                $('#comment-error').html('');
                $('#comment-comment').val('');
                $('#comment').html(res);
                // console.log(res);
            }
        }
    });
});

$(document).on('click', '.btn-show-reply-form', function(ev) {
    ev.preventDefault();
    var id = $(this).data('id');
    var comment_reply_id = '#comment-reply-' + id;
    var commentReply = $(comment_reply_id).val();
    var form_reply = '.form-reply-' + id;
    $('.formReply').slideUp();
    $(form_reply).slideDown();
});

$(document).on('click', '.btn-send-comment-reply', function(ev) {
    ev.preventDefault();
    var _csrf = '{{csrf_token()}}';
    var id = $(this).data('id');
    var comment_reply_id = '#comment-reply-' + id;
    var commentReply = $(comment_reply_id).val();
    var form_reply = '.form-reply-' + id;

    $.ajax({
        url: _commentUrl,
        type: 'POST',
        data: {
            comment: commentReply,
            rep_id: id,
            _token: _csrf
        },
        success: function(res) {
            if (res.error) {
                $('#comment-error').html(res.error);
            } else {
                $('#comment-error').html('');
                $('#comment-comment').val('');
                $('#comment').html(res);
                // console.log(res);
            }
        }
    });
});
</script>
@stop()