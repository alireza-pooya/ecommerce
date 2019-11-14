@extends('layouts.homebase')
@section('content')

<div id="da-slider" class="da-slider" style="z-index: 0">
    @foreach($slideshows as $slideshow)

    <div class="da-slide">
        <a href="{{ $slideshow->link }}" target="_blank"><h2>{{ $slideshow->title }}</h2></a>
        <p>{{ $slideshow->body }}</p>
        <div class="da-img"> <a href="{{ $slideshow->link }}" target="_blank"><img src="{{ url($slideshow->image) }}" alt="image01" class="responsive-img" /></a></div>
    </div>
    @endforeach
    <nav class="da-arrows">
        <span class="da-arrows-prev"></span>
        <span class="da-arrows-next"></span>
    </nav>
</div>
    <div class="clearfix"></div>
    <div class="row no-gutters justify-content-center mt-5">
        @foreach($products as $product)
            <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2 m-3 d-flex justify-content-center">
                <div class="item" style="background-image: url( {{$product->img}} )">
                    <div class="item-overlay">
                        <div class="sale-tag"><span>SALE</span></div>
                    </div>
                    <div class="item-content">
                        <div class="item-top-content">
                            <div class="item-top-content-inner">
                                <div class="item-product">
                                    <div class="item-top-title">
                                        <h2><b>{{ $product->name }}</b></h2>
                                        <h2>New Price</h2>
                                        <p class="subdescription" style="margin-bottom: 0">
                                            Old Price
                                        </p>
                                    </div>
                                </div>
                                <div class="item-product-price">
                                    <small class="text-muted star">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    <span class="price-num">${{ $product->new_price }}</span>
                                    <p><s> ${{ $product->old_price }}</s></p>
                                </div>
                            </div>
                        </div>
                        <div class="item-add-content">
                            <div class="section">
                                <a class="btn buy expand" href="{{ route('product.show',['product'=>$product->slug]) }}">Buy now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 d-flex justify-content-center m-3">{{ $products->render() }}</div>
    </div>
    <div class="clearfix"></div>
    <div class="col-12 mt-5 mb-5">
        <div class="swiper-container2">
            <div class="swiper-wrapper">
                @foreach($products as $product)
                <div class="swiper-slide ">
                   <div><a href="{{ route('product.show',['product'=>$product->slug]) }}"><img class="card-img-top" src="{{ url( $product->img ) }}" style="height: 270px" alt="Card image"></a></div>
                    <div class="card-body">
                        <p class="p"><a href="https://en.wikipedia.org/wiki/Red">40% OFF</a></p>
                        <p class="p2"><a href="https://en.wikipedia.org/wiki/Green">{{ $product->name }}</a></p>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row no-gutters justify-content-center">
        <div class="col-12 col-md-5 mb-5 mr-2  shadow-lg">
            <div class="middle_pic">
                <a href=""><img src="{{url('images/slider/zzz.jpg')}}" alt=""></a>
            </div>
        </div>
        <div class="col-12 col-md-5 mb-5 ml-2  shadow-sm">
            <div class="middle_pic">
                <a href=""><img src="{{url('images/slider/dd.jpg')}}" alt=""></a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <section>
        <div class="top-brand">
            <div class="title m-5">
                <h3>TOP BRANDS</h3>
            </div>
            <div class="clearfix"></div>
            <div class="carousel_slider">
                <div class="owl-carousel">
                    @foreach($topBrands as $topBrand)
                    <div><a href="{{  $topBrand->link }}"><img  src="{{ url( $topBrand->image ) }}" alt=""></a></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')

    <script type="text/javascript" src="{{ url('/js/cslider/jquery.cslider.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/cslider/modernizr.js') }}"></script>
    <script>


        $(document).ready(function () {
            $(function () {
                $('#da-slider').cslider({
                    autoplay: true,
                    bgincrement: 450
                });

            });
        });
        var swiper = new Swiper('.swiper-container2', {
            slidesPerView: 5,
            spaceBetween: 30,
            freeMode: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                540: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1400: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            }
        });

        $("window").load(function() {
            $("#body").removeClass("preload");
        });

        $(".share-btn").mouseenter(function() {
            setTimeout(function() {
                $(".item-menu").addClass("visible")
            }, 500);
        });
        $(".share-btn").mouseleave(function() {
            setTimeout(function() {
                $(".item-menu").removeClass("visible")
            }, 500);
        });
        $(".item-menu").hover(function() {
            $(".item-menu").addClass("visible")
        });
        $(".item-menu").mouseleave(function() {
            setTimeout(function() {
                $(".item-menu").removeClass("visible")
            }, 500);
        });
        $(".container-item").hover(function() {
            setTimeout(function() {
                $(".container-item").css("z-index", "1000")
            }, 500);
        });
    </script>
@endsection