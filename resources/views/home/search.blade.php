@extends('layouts.homebase')
@section('content')

    <div class="clearfix"></div>
    <div class="row no-gutters justify-content-center mt-5" style="min-height: 600px;">
        @if(count($productions))
            @foreach($productions as $product)
                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2 m-3 d-flex justify-content-center">
                    <div class="item" style="background-image: url( {{ $product->img }} )">
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
                                    <a class="btn buy expand"
                                       href="{{ route('product.show',['product'=>$product->slug]) }}">Buy now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 justify-content-center">
                <div>
                    <h1 class="text-center"><b>products not found</b></h1>
                </div>
            </div>
        @endif
        <div class="col-12 d-flex justify-content-center m-3">{{ $productions->render() }}</div>
    </div>
@endsection
