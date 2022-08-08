@extends('layout.fe')
@section('main')

<?php $lang = Session::get('lang');
if (!isset($lang) || $lang == 'vi') {
    $lang = config('langVi');
} else {
    $lang = config('langEn');
} ?>

<link rel="stylesheet" href="https://cdn.leanhduc.pro.vn/utilities/animation/shake-effect/style.css" />
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
<div class="khuyenmai rung">
    <p>Từ ngày <?= $promotion[0]['time_start'] ?> đến ngày <?= $promotion[0]['time_end'] ?> </p>
    <p>Khuyến mãi lên đến <?= $promotion[0]['detail'] ?> <?= $promotion[0]['type'] ?> mỗi đơn hàng</p>
</div>
@endif
<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Cửa hàng mua sắm trực tuyến thả ga</h2>
                                <p>Bạn sẽ có mọi thứ mà bạn mong muốn nếu như bạn diện đồ vì chúng. </p>
                                <button type="button" class="btn btn-default get">Mua ngay</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{url('/fe')}}/images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                <img src="{{url('/fe')}}/images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Cửa hàng mua sắm trực tuyến thả ga</h2>
                                <p>Phong cách là một phương thức để nói lên bạn là ai mà không khiến bạn tốn một lời.
                                </p>
                                <button type="button" class="btn btn-default get">Mua ngay</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{url('/fe')}}/images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                <img src="{{url('/fe')}}/images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Không chỉ còn là trang phục, đó là Life Style</h2>
                                <p>Cung cấp những mặc hàng tốt nhất, chất lượng nhất đến với mọi người. </p>
                                <button type="button" class="btn btn-default get">mua ngay</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{url('/fe')}}/images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                <img src="{{url('/fe')}}/images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/slider-->

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
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center" style="margin-top: 5px;">{{$model->name}}</h2>
                    @foreach($model->products as $pro)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{url('/uploads/'.$pro->image)}}" alt="" />
                                    @if($pro->sale_price > 0)
                                    <h2><s>{{'₫'.number_format($pro->price)}}</s> -
                                        <b>{{'₫'.number_format($pro->sale_price)}}</b>
                                    </h2>
                                    @else
                                    <h2><b>{{'₫'.number_format($pro->price)}}</b></h2>
                                    @endif
                                    <p>{{$pro->name}}</p>
                                    <a href="{{route('cart.add',$pro->id)}}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</section>
@stop()