@extends('layout.fe')
@section('main')

<?php $lang = Session::get('lang'); if(!isset($lang) || $lang == 'vi') {$lang = config('langVi');} else {$lang = config('langEn');} ?>

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
                                <h2>{{$lang['banner']['banner1']}}</h2>
                                <p>{{$lang['banner']['banner2']}}</p>
                                <button type="button" class="btn btn-default get">{{$lang['banner']['button']}}</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{url('fe')}}/images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                <img src="{{url('fe')}}/images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>{{$lang['banner']['banner3']}}</h2>
                                <p>{{$lang['banner']['banner4']}}</p>
                                <button type="button" class="btn btn-default get">{{$lang['banner']['button']}}</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{url('fe')}}/images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                <img src="{{url('fe')}}/images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>{{$lang['banner']['banner5']}}</h2>
                                <p>{{$lang['banner']['banner6']}}</p>
                                <button type="button" class="btn btn-default get">{{$lang['banner']['button']}}</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{url('fe')}}/images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                <img src="{{url('fe')}}/images/home/pricing.png" class="pricing" alt="" />
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
                        <img src="{{url('fe')}}/images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>
            <div class="pull-right">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="{{$lang['menu']['menu12']}}"
                            value="{{request('key')}}">
                    </div>
                    <div class="form-group">
                        <select name="cat_id" class="form-control">
                            <option value="">Chọn danh mục</option>
                            @foreach($category as $cat)
                            <?php $selected = $cat->id == request('cat_id')? 'selected' :'';?>
                            <option value="{{$cat->id}}" {{$selected}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="price" class="form-control">
                            <option value="">Sắp xếp</option>
                            <option value="price-ASC">Giá từ thấp tới cao</option>
                            <option value="price-DESC">Giá từ cao xuống thấp</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn giá từ</label>
                        <input style="max-width: 75px;" type="number" class="form-control" name='for-price' value="{{request('for-price')}}" placeholder="Nhập giá tiền">
                        <label for="">Đến</label>
                        <input style="max-width: 75px;" type="number" class="form-control" name='to-price' value="{{request('to-price')}}" placeholder="Nhập giá tiền">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center" style="padding-top:5px">{{$lang['title']['product']}}</h2>
                    @foreach($products as $pro)
                    @if($pro->sale_price>0)
                    @else
                    <a href="{{route('product_detail', $pro->slug)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{url('uploads/'.$pro->image)}}" alt="" />
                                        <h2>{{'₫'.number_format($pro->price)}}</h2>
                                        <p>{{$pro->name}}</p>
                                        <a href="{{route('product_detail', $pro->slug)}}"
                                            class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>{{$lang['title']['button']}}</a>
                                        <a href="{{route('cart.add',$pro->id)}}" class="btn btn-default cart"><i
                                                class="fa fa-shopping-cart"></i> {{$lang['product']['product2']}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                    @endforeach
                </div>

                <!--features_items-->
                <!--new_items-->
                <div class="recommended_items">
                    <?php if (count($newProduct[0]) == 0) {
                    } else { ?>
                    <h2 class="title text-center" style="padding-top: 5px">{{$lang['title']['newProduct']}}</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div
                                class="<?= count($newProduct[0]) == 3 && count($newProduct[1]) != 0 ? 'active' : ''  ?> item">
                                <?php foreach ($newProduct[0] as $nPrd) {   ?>
                                @if($nPrd->sale_price > 0)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{url('')}}/uploads/{{$nPrd['image']}}" alt="" />
                                                @if($nPrd->sale_price > 0)
                                                <h2><s>{{'₫'.number_format($nPrd['price'])}}</s> -
                                                    <b>{{'₫'.number_format($nPrd['sale_price'])}}</b>
                                                </h2>
                                                @else
                                                <h2><b>{{'₫'.number_format($nPrd['price'])}}</b></h2>
                                                @endif
                                                <p>{{$nPrd['name']}}</p>
                                                <a href="{{route('product_detail', $nPrd['slug'])}}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>{{$lang['title']['button']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                @endif
                                <?php   }   ?>
                            </div>
                            <div class="item">
                                <?php foreach ($newProduct[1] as $nPrd) {   ?>
                                @if($nPrd->sale_price > 0)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{url('')}}/uploads/{{$nPrd['image']}}" alt="" />
                                                @if($nPrd->sale_price > 0)
                                                <h2><s>{{'₫'.number_format($nPrd['price'])}}</s> -
                                                    <b>{{'₫'.number_format($nPrd['sale_price'])}}</b>
                                                </h2>
                                                @else
                                                <h2><b>{{'₫'.number_format($nPrd['price'])}}</b></h2>
                                                @endif
                                                <p>{{$nPrd['name']}}</p>
                                                <a href="{{route('product_detail', $nPrd['slug'])}}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>{{$lang['title']['button']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                @endif
                                <?php   }   ?>
                            </div>
                            <?php if(count($newProduct[2]) > 0) { ?>
                            <div class="item">
                                <?php foreach ($newProduct[2] as $nPrd) {   ?>
                                @if($nPrd->sale_price > 0)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{url('')}}/uploads/{{$nPrd['image']}}" alt="" />
                                                @if($nPrd->sale_price > 0)
                                                <h2><s>{{'₫'.number_format($nPrd['price'])}}</s> -
                                                    <b>{{'₫'.number_format($nPrd['sale_price'])}}</b>
                                                </h2>
                                                @else
                                                <h2><b>{{'₫'.number_format($nPrd['price'])}}</b></h2>
                                                @endif
                                                <!-- <h2>{{'₫'.number_format($nPrd['sale_price'])}}</h2> -->
                                                <p>{{$nPrd['name']}}</p>
                                                <a href="{{route('product_detail', $nPrd['slug'])}}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>{{$lang['title']['button']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                @endif
                                <?php   }   ?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if (count($newProduct[0]) == 3 && count($newProduct[1]) != 0) { ?>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <!--/new_items-->

                <!--hotSale_items-->
                <div class="recommended_items">
                    <h2 class="title text-center" style="padding-top: 5px">{{$lang['title']['topSale']}}</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php foreach ($topSale as $sPrd) {   ?>

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{url('')}}/uploads/{{$sPrd['image']}}" alt="" />
                                                @if($sPrd->sale_price > 0)
                                                <h2><s>{{'₫'.number_format($sPrd['price'])}}</s> -
                                                    <b>{{'₫'.number_format($sPrd['sale_price'])}}</b>
                                                </h2>
                                                @else
                                                <h2><b>{{'₫'.number_format($sPrd['price'])}}</b></h2>
                                                @endif
                                                <p>{{$sPrd['name']}}</p>
                                                <a href="{{route('product_detail', $sPrd['slug'])}}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>{{$lang['title']['button']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php   }   ?>
                            </div>
                        </div>
                        <!-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a> -->
                    </div>
                </div>
                <!--/hotSale_items-->

            </div>
        </div>
    </div>
</section>
@stop()