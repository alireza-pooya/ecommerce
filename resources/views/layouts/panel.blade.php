<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugin/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugin/cropper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('css/panel.css')}}">
    <link rel="stylesheet" href="{{ url('css/plugin/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ url('css/plugin/smart_wizard.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/plugin/smart_wizard_theme_dots.css') }}">

    <link rel="icon" type="image/png" href="{{ url('images/favicon-32x32.jpeg') }}" sizes="32x32">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    @yield('header')
</head>
<body>
<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>PooyaShop Panel</h3>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-home"></span>&nbsp;&nbsp; Home page</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="{{ route('slideshow.index') }}">Slide show</a>
                    </li>
                    <li>
                        <a href="{{ route('topbrand.index') }}">Top Brand</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#product" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-store"></span>&nbsp;&nbsp; Product</a>
                <ul class="collapse list-unstyled" id="product">
                    <li>
                        <a href="{{ route('product.index') }}">Show Products</a>
                    </li>
                    <li>
                        <a href="{{ route('product.create') }}">Add New Product</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('purchase.index') }}"><span class="fa fa-dollar"></span>&nbsp;&nbsp; Purchase</a>
            </li>
            <li>
                <a href="{{ route('user.index') }}"><span class="fa fa-id-card"></span>&nbsp;&nbsp; Users</a>
            </li>
            <li>
                <a href="{{ route('brand.index') }}"><span class="fa fa-tag"></span>&nbsp;&nbsp; Brand</a>
            </li>
            <li>
                <a href="{{ route('category.index') }}"><span class="fa fa-pie-chart"></span>&nbsp;&nbsp; Category</a>
            </li>
            <li>
                <a href="{{ route('property.index') }}"><span class="fa fa-info-circle"></span>&nbsp;&nbsp; Property</a>
            </li>
            <li>
                <?php use App\Contact;$pending_contact = Contact::whereNull('response')->where('created_at','>=',now()->subHour(48))->count();?>
                <a href="{{ route('contact.index') }}"><span class="fa fa-envelope"></span>&nbsp;&nbsp; Contact Us @if($pending_contact)<span class="pending ml-3">{{ $pending_contact }}</span> @endif</a></a>
            </li>
            <li>
                <?php use App\Comment;$pending_comment = Comment::where('approved',0)->where('created_at','>=',now()->subHour(48))->count();?>
                <a href="{{ route('comment.index') }}"><span class="fa fa-comment"></span>&nbsp;&nbsp; Comment @if($pending_comment)<span class="pending ml-3">{{ $pending_comment }}</span> @endif</a></a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-percent"></span>&nbsp;&nbsp; Discount Code</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{ route('discount.index') }}">Show Discount Code</a>
                    </li>
                    <li>
                        <a href="{{ route('discount.create') }}">Add Discount Code</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light secondNav">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" style=" color: #b3b7bb" href="{{route('homepage.home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style=" color: #b3b7bb" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid border-primary" style="background-color: white; ">
            <div class="frame">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript' src="{{ url('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/plugin/select2.min.js') }}"></script>
<script type='text/javascript' src="{{ url('js/panel.js') }}"></script>
<script type='text/javascript' src="{{ url('js/plugin/moment.min.js') }}"></script>
<script type='text/javascript' src="{{ url('js/plugin/daterangepicker.js') }}"></script>
<script type='text/javascript' src="{{ url('js/plugin/jquery.smartWizard.min.js') }}"></script>
<script type="text/javascript"> var asli_url = '{!! url('') !!}'; </script>
@yield('footer')
</body>
</html>