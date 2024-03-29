<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{url('/fe')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/fe')}}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/fe')}}/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{url('/fe')}}/css/price-range.css" rel="stylesheet">
    <link href="{{url('/fe')}}/css/animate.css" rel="stylesheet">
    <link href="{{url('/fe')}}/css/main.css" rel="stylesheet">
    <link href="{{url('/fe')}}/css/responsive.css" rel="stylesheet">
    @yield('css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/be')}}/plugins/fontawesome-free/css/all.min.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="{{route('home.index')}}"><img src="{{url('/fe')}}/images/home/logo.png"
                                    alt="" /></a>
                        </div>
                        <div class="btn-group pull-right clearfix">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    {{$lang['lang']}}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('home.lang','VN')}}">VN</a></li>
                                    <li><a href="{{route('home.lang','EN')}}">EN</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    VND
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canadian Dollar</a></li>
                                    <li><a href="">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <!-- <li><a href=""><i class="fa fa-star"></i>{{$lang['topNav']['nav1']}}</a></li>
                                <li><a href="checkout.html"><i
                                            class="fa fa-crosshairs"></i>{{$lang['topNav']['nav2']}}</a></li> -->
                                <li><a href="{{route('cart.view')}}"><i
                                            class="fa fa-shopping-cart"></i>{{$lang['topNav']['nav3']}}</a></li>
                                @if(Auth::guard('cus')->check())
                                <li>
                                    <a href=""><i class="fa fa-user"></i>Hi {{Auth::guard('cus')->user()->name}}
                                        <?php if (Auth::guard('cus')->user()->tich_diem > 1000000 && Auth::guard('cus')->user()->tich_diem < 2000000) {
                                        ?>
                                        <span>Đồng</span>
                                        <?php
                                        } elseif (Auth::guard('cus')->user()->tich_diem > 2000000 && Auth::guard('cus')->user()->tich_diem < 3000000) {
                                        ?>
                                        <span>Bạc</span>
                                        <?php
                                        } elseif (Auth::guard('cus')->user()->tich_diem > 3000000 && Auth::guard('cus')->user()->tich_diem < 4000000) {
                                        ?>
                                        <span>Vàng</span>
                                        <?php
                                        } elseif (Auth::guard('cus')->user()->tich_diem > 4000000) {
                                        ?>
                                        <span>Kim Cương</span>
                                        <?php
                                        } ?>
                                    </a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{route('customer.profile')}}"
                                                style="color: #000;">{{$lang['topNav']['nav4']}}</a>
                                        </li>
                                        <li><a href="{{route('home.order.history')}}"
                                                style="color: #000;">{{$lang['topNav']['nav5']}}</a>
                                        </li>
                                        <li><a href="{{route('customer.changepassword')}}"
                                                style="color: #000;">{{$lang['topNav']['nav6']}}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('customer.logout')}}"><i
                                            class="fa fa-lock"></i>{{$lang['topNav']['nav7']}}</a>
                                </li>
                                @else
                                <li>
                                    <a href="{{route('customer.login')}}"><i class="fa fa-lock"></i>
                                        {{$lang['topNav']['nav8']}}</a>
                                </li>
                                <li>
                                    <a href="{{route('customer.register')}}"><i
                                            class="fa fa-lock"></i>{{$lang['topNav']['nav9']}}</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{route('home.index')}}" class="active">{{$lang['menu']['menu1']}}</a></li>
                                <!-- <li class="dropdown"><a href="#">{{$lang['menu']['menu2']}}<i
                                            class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="">{{$lang['menu']['menu3']}}</a></li>
                                        <li><a href="product-details.html">{{$lang['menu']['menu4']}}</a></li>
                                        <li><a href="checkout.html">{{$lang['menu']['menu5']}}</a></li>
                                        <li><a href="cart.html">{{$lang['menu']['menu6']}}</a></li>
                                        <li><a href="login.html">{{$lang['menu']['menu7']}}</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">{{$lang['menu']['menu8']}}<i
                                            class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">{{$lang['menu']['menu9']}}</a></li>
                                        <li><a href="blog-single.html">{{$lang['menu']['menu10']}}</a></li>
                                    </ul>
                                </li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="contact-us.html">{{$lang['menu']['menu11']}}</a></li> -->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->
    <div class="container">
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('error')}}
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('success')}}
        </div>
        @endif
    </div>

    @yield('main')

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{url('/fe')}}/images/home/iframe1.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{url('/fe')}}/images/home/iframe2.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{url('/fe')}}/images/home/iframe3.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{url('/fe')}}/images/home/iframe4.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{url('/fe')}}/images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>{{$lang['footer']['footer1']}}</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">{{$lang['footer']['footer2']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer3']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer4']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer5']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer6']}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>{{$lang['footer']['footer7']}}</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">{{$lang['footer']['footer8']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer9']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer10']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer11']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer12']}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>{{$lang['footer']['footer13']}}</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">{{$lang['footer']['footer14']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer15']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer16']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer17']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer18']}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>{{$lang['footer']['footer19']}}</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">{{$lang['footer']['footer20']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer21']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer22']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer23']}}</a></li>
                                <li><a href="#">{{$lang['footer']['footer24']}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="{{$lang['footer']['footer25']}}" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>{{$lang['footer']['footer26']}}</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{url('/fe')}}/js/jquery.js"></script>
    <script src="{{url('/fe')}}/js/bootstrap.min.js"></script>
    <script src="{{url('/fe')}}/js/jquery.scrollUp.min.js"></script>
    <script src="{{url('/fe')}}/js/price-range.js"></script>
    <script src="{{url('/fe')}}/js/jquery.prettyPhoto.js"></script>
    <script src="{{url('/fe')}}/js/main.js"></script>

    @yield('js')
</body>

</html>