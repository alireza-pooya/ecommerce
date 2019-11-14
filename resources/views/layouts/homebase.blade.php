<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PooyaShop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugin/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugin/cropper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugin/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/cslider/style2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/login/login.css') }}">
    <link rel="icon" type="image/png" href="{{ url('images/favicon-32x32.jpeg') }}" sizes="32x32">
    @yield('header')
</head>
<body>

<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light menu d-block">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="text-white titr"><b>POOYA SHOP</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('homepage.home') }}" tabindex="-1"
                       aria-disabled="true">Home</a>
                </li>
            </ul>
            <form action="{{ route('homepage.home') }}" class="form-inline col-12 col-md-8">
                <div class="input-group col-12">
                    <input type="text" class="form-control" placeholder="search..." name="search" aria-label="Username"
                           aria-describedby="basic-addon1">
                    <button class="btn btn-success search"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav">
                <?php
                use App\Category;if (auth()->check()) {
                    $user = Auth::id();
                    $productsCart = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($user) {
                        return $cartItem->options->user_id === $user;
                    })->count();
                } else {
                    $productsCart = null;
                }
                ?>
                <a class="nav-link text-white d-inline-block" href="{{ route('cart') }}"><i
                            class="fa faCart fa-shopping-cart"></i><span class="cart_number"><b>{{ $productsCart }}</b></span></a>
                <a class="nav-link text-white d-inline-block" href="#">
                    @if(Auth::check())
                        <a href="{{ route('dashboard.index') }}" class="mt-3"
                           style="color: white;"><b> {{ Auth()->user()->full_name }}</b></a>
                        <a class="nav-link text-white m-2" href="{{ route('logout') }}"><b>Logout</b><span
                                    class="sr-only">(current)</span></a>
                    @else
                        <a href="{{ route('login') }}" class="mt-1" style="color: white;"><i class="fa fa-user-circle"
                                                                                             style="font-size: 30px"></i>Login</a>
                @endif
            </ul>
            <div class="form-inline">
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav second_nav">
                <?   $categories = Category::where('parent_id', null)->with('children')->get(); ?>
                @foreach($categories as $category)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $category->name }}
                        </a>
                        <div class="dropdown-menu drop" aria-labelledby="navbarDropdown">
                            <h6 class="dropdown-header"><b>{{ $category->name }}</b></h6>
                            <div class="dropdown-divider"></div>
                            @foreach($category->children as $child)

                                <a class="dropdown-item" href="{{ route('category.search',['$category'=>$child->id]) }}">{{ $child->name }}</a>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>
<div class="clearfix"></div>

@yield('content')

<div class="clearfix"></div>

<footer id="footer" class="footer-1 mt-5">
    <div class="main-footer widgets-dark typo-light pt-5">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="widget subscribe no-box">
                        <h5 class="widget-title">POOYA SHOP<span></span></h5>
                        <p>About the company, little discription will goes here.. </p>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="widget no-box">
                        <h5 class="widget-title">Quick Links<span></span></h5>
                        <ul class="thumbnail-widget">
                            <li>
                                <div class="thumb-content"><a href="#.">Get Started</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="#.">Top Leaders</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="#.">Success Stories</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="#.">Event/Tickets</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="#.">News</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="#.">Lifestyle</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="#.">About</a></div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="widget no-box">
                        <h5 class="widget-title">Get Started<span></span></h5>
                        <p>Get access to your full Training and Marketing Suite.</p>
                        <a class="btn btn-info" href="{{ route('register') }}">Register Now</a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">

                    <div class="widget no-box">
                        <h5 class="widget-title"><a href="{{route('contact.home')}}" style="color: white">Contact Us</a><span></span>
                        </h5>
                        <p><a href="mailto:ali.r.pooya@gmail.com" style="color: wheat">ali.r.pooya@gmail.com</a></p>
                        <ul class="social-footer2">
                            <li class=""><a title="youtube" target="_blank" href="https://www.youtube.com/"><span
                                            class="fa fa-youtube-play"></span></a></li>
                            <li class=""><a href="https://www.facebook.com/" target="_blank" title="Facebook"><span
                                            class="fa fa-facebook"></span></a></li>
                            <li class=""><a href="https://twitter.com" target="_blank" title="Twitter"><span
                                            class="fa fa-twitter"></span></a></li>
                            <li class=""><a title="instagram" target="_blank" href="https://www.instagram.com/"><span
                                            class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Copyright PooyaShop © 2019. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>
<!-- /.col-lg-9 -->

</div>
<!-- /.row -->
<script type='text/javascript' src="{{ url('js/jquery.min.js') }}"></script>
<script type='text/javascript' src="{{ url('js/plugin/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/home.js') }}"></script>
<script type="text/javascript" src="{{ url('js/plugin/cropper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/swiper/swiper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/plugin/select2.min.js') }}"></script>
<script type="text/javascript"> var asli_url = '{!! url('') !!}'; </script>
@yield('footer')

</body>
</html>