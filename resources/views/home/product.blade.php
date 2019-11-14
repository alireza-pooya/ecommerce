@extends('layouts.homebase')
@section('header')
    <link rel="stylesheet" href="{{ url('css/magnifier/jquery.exzoom.css') }}">
    {!! htmlScriptTagJsApiV3(['action' => 'homepage.home']) !!}
    <style>
        .star {
            font-size: 30px;
            color: orange;
        }
    </style>
@endsection
@section('content')
    <div class="col-12 col-md-10  offset-md-1 mt-5">
        <div class="mb-3 shadow form-bg">
            @include('layouts.messages')
            @include('layouts.errors')
            <div class="row no-gutters justify-content-around">

                <div class="col-12 col-lg-3  mt-5 pr-2 pl-2">
                    <h1 class="text-sm-left"><b>{{ $product->name }}</b></h1>
                    <hr>
                    @if($rate != null)
                    <small class="text-muted star">
                        @for($i=0;$i < $rate ; $i++)
                        &#9733;
                        @endfor
                    </small>out of {{ $count }} Votes
                    @else
                        <small class="text-muted"><h6>There Is No Vote </h6></small>
                    @endif
                    <hr>
                    <h4><b>{{ $product->brand->name }}</b></h4>
                    <hr>
                    <h4><i class="fa fa-file-archive-o"></i><b>&nbsp;&nbsp; Two years Guarantee</b></h4>
                    <hr>
                    <? $quantity = 0;
                    foreach ($product->stores as $qt)
                        $quantity += $qt->quantity;
                    ?>
                    @if($quantity == 0 )
                        <h4><i class="fa fa-truck"></i><b>&nbsp;&nbsp; Out Of Stock</b></h4>
                    @else
                        <h4><i class="fa fa-truck"></i><b>&nbsp;&nbsp; Ready to shipping</b></h4>
                    @endif
                    <hr>
                    <h4 class="d-inline-block"><i class="fa fa-usd"></i></h4><h6 class="d-inline-block">&nbsp;&nbsp; <s>
                            ${{ $product->old_price  }}</s></h6><h4 class="d-inline-block"><b>&nbsp;&nbsp;
                            ${{ $product->new_price }}</b></h4>
                    <hr>
                    <h4>description</h4>
                    <span>{{ $product->description }}</span>
                </div>

                <div class="col-12 col-lg-4 mt-5 pt-5 pr-2 pl-2">
                    @if($quantity == 0)
                        <h5><b style="color: red">This product is out of stock</b></h5>
                    @else
                        <form action="{{ route('cart.add',['product'=>$product->slug]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="product" id="product" value="{{ $product->id }}">

                            <div class="row no-gutters justify-content-between">
                                <div class="col-12 col-md-5">
                                    <label for=""><b>Available color :</b> </label>
                                    <select class="select2 colorChange form-control" id="color" tabindex="-1"
                                            name="color">
                                        <option {{old("color") ? "selected" : ''}} value=""></option>
                                        @foreach ($stores as $key => $store)
                                            <option value="{{ $key }}"
                                                    {{ Request()->color == $key  ? 'selected' : ''}} style="background-color: {{ $key }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-5">
                                    <label for=""><b>Available size :</b> </label>
                                    <select class="select2 availableSizes changeSize form-control" tabindex="-1"
                                            id="size" name="size" disabled>
                                        <option {{ old("size") ? "selected" : ''}} value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                @if($quantity > 10 )
                                    <? $quantity = 10 ?>
                                @endif
                                <label><b>Number of product :</b></label>
                                <select class="select2 availableQuantities form-control" tabindex="-1" name="quantity"
                                        disabled>

                                </select>
                                <span class="focus-border"></span>
                            </div>
                            <button class="btn btn-info form-control mt-5"><h4>Add to cart &nbsp;&nbsp;&nbsp;<i
                                            class="fa fa-shopping-cart"></i></h4></button>
                        </form>
                        <a href="" class="btn btn-success form-control mt-3 mb-3"><h4>Buy it now &nbsp;&nbsp;&nbsp;<i
                                        class="fa fa-credit-card"></i></h4></a>
                    @endif
                    <hr>
                </div>

                <div class="col-12 col-lg-4 mb-5 ">
                    <h1 class="text-center pt-5 "><b>Galleries</b></h1>
                    <div class="exzoom pl-2" id="exzoom">
                        <!-- Images -->
                        <div class="exzoom_img_box">
                            <ul class='exzoom_img_ul'>
                                @foreach($galleries as $gallery)
                                    <li><img src="{{ url( $gallery ) }}"/></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                        <div class="exzoom_nav"></div>
                        <!-- Nav Buttons -->
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-12 col-md-10 offset-md-1">
        <div class="shadow form-bg">

            <!-- Tabs - Page -->
            <div class="tabs-page">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="tab-active active"><a href="#properties" aria-controls="properties"
                                                                         role="tab"
                                                                         data-toggle="tab">Properties</a></li>
                    <li role="presentation" class="tab-active"><a href="#comments" aria-controls="comments" role="tab"
                                                                  data-toggle="tab">Comments & Rating</a></li>
                </ul><!-- ./ nav tabs -->
            </div><!-- ./ tabs page -->

            <div class="tabs-page">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="properties">
                        <div class="row no no-gutters">
                            <div class="col-sm-12">
                                <ul>
                                    @foreach($product->properties as $property)
                                        <li class="row no-gutters justify-content-between">
                                            <div class="property col-12 col-md-3 pull-left">
                                                <h3><b>{{ $property->name }} : </b></h3>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <span style="line-height: 6">{{ $property->pivot->value }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="comments">
                        <div class="row no-gutters justify-content-around">
                            <div class="col-12 col-md-5 m-5">
                                <h3 class="text-center"><b>Users Comments</b></h3>
                                <hr>
                                @foreach($comments as $comment)
                                    <div class="mt-5">
                                        <h4 class="d-inline-block mr-2"><b>Published Date :</b></h4>
                                        <span>{{ $comment->created_at }}</span> <br>
                                        <h4 class="d-inline-block mr-5"><b>Rate The Product :</b></h4>
                                        @for($i=0 ; $i < $comment->rating ; $i++)
                                            <small class="star d-inline-block">&#9733; </small>
                                        @endfor
                                        <br>
                                        <h4 class="d-inline-block"><b>User :</b></h4>
                                        <span>{{ $comment->user['full_name']}}</span><br>
                                        <h4 class="d-inline-block"><b>Title :</b></h4>
                                        <span>{{ $comment->title }}</span> <br>
                                        <h4 class="d-inline"><b>Comment :</b></h4>
                                        <span>{{ $comment->body }}</span>
                                    </div>
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                                <div class="col-12 mt-5">{{ $comments->render() }}</div>
                            </div>
                            <div class="col-12 col-md-5 m-5">
                                <h3 class="text-center"><b>Your Review To Product</b></h3>
                                <hr>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <form action="{{ route('comment.store',['product'=>$product->slug]) }}"
                                          method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="rating" class="col-form-label-lg"><b>*Rate The Product :</b>
                                            </label>
                                            <div class="rating d-inline-block ml-5" id="rating">
                                                <input type="radio" name="rating" id="r1" value="5">
                                                <label for="r1"></label>
                                                <input type="radio" name="rating" id="r2" value="4">
                                                <label for="r2"></label>
                                                <input type="radio" name="rating" id="r3" value="3">
                                                <label for="r3"></label>
                                                <input type="radio" name="rating" id="r4" value="2">
                                                <label for="r4"></label>
                                                <input type="radio" name="rating" id="r5" value="1">
                                                <label for="r5"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label-lg pb-0"><b>*Title :</b></label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                   placeholder="please enter title" value="{{ old('value') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="body" class="col-form-label-lg pb-0"><b>*Comment :</b></label>
                                            <textarea name="body" id="body" class="form-control" cols="30" rows="10"
                                                      placeholder="write a review">{{ old('body') }}</textarea>
                                        </div>
                                        <button class="btn btn-info form-control">send</button>
                                    </form>
                                @else
                                    <div class="text-center mt-5">
                                        <h1>Please <b><a href="{{ route('login') }}">Sign In</a></b></h1>
                                        <h1>To </h1>
                                        <h1> Review To This Product</h1>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center mt-5 mb-3"><h1><b>Similar sponsored items</b></h1></div>
    <div class="col-12 col-md-10  offset-md-1">
        <div class="shadow form-bg">
            <div class="carousel_slider">
                <div class="owl-carousel m-2">
                    @foreach($productions as $product1)
                        <div>
                            <div><a href="{{ route('product.show',['product'=>$product1->slug]) }}"><img class="card-img-top" src="{{ url( $product1->img ) }}" style="height: 200px"
                                            alt="Card image"></a></div>
                            <div class="card-body">
                                <p class="p"><a href="https://en.wikipedia.org/wiki/Red">40% OFF</a></p>
                                <p class="p2"><a href="https://en.wikipedia.org/wiki/Green">{{ $product1->name }}</a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{ url('/js/magnifier/jquery.exzoom.js') }}"></script>
    <script>
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).on('change', '.colorChange', function () {
                var product = $('#product').val();
                var colorCode = $('#color').val();
                $.ajax({
                    'url': '{{ route('color') }}',
                    'type': 'POST',
                    'data': {product_id: product, colorCode: colorCode},
                    success: function (response) { // What to do if we succeed
                        let data = response.data.store;
                        let sizeOptions = "";
                        sizeOptions += "<option></option>";
                        data.map(item => {
                            sizeOptions += "<option value='" + item.id + "'>" + item.size + "</option>";
                        });

                        $('.availableSizes').html(sizeOptions).attr('disabled', false);
                    },
                    error: function (response) {
                        alert('Error' + response);
                    }
                });
            });
        });
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).on('change', '.changeSize', function () {
                var storeId = $('#size').val();
                $.ajax({
                    'url': '{{ route('quantity') }}',
                    'type': 'POST',
                    'data': {store_id: storeId},
                    success: function (response) { // What to do if we succeed
                        let data = response.data;
                        let quantity = "";
                        let qty = 0;
                        console.log(data);
                        if (data >= 10) {
                            qty = 10;
                        } else {
                            qty = data;
                        }
                        for (i = 1; i <= qty; i++) {
                            quantity += "<option value='" + i + "'>" + i + "</option>";
                        }
                        $('.availableQuantities').html(quantity).attr('disabled', false);
                    },
                    error: function (response) {
                        alert('Error' + response);
                    }
                });
            });
        });

        $(function () {
            $("#exzoom").exzoom({});
        });

        $('.tab-active').on('click', function () {
            $('.tab-active').removeClass('active');
            $(this).addClass('active');
        });
    </script>

@endsection
