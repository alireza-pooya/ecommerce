@extends('layouts.panel')
@section('header')
    <title>panel-Edit product</title>
    <style>
        .image {
            width: 200px;
            height: 200px;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Edit product {{ $product->name }}</h1>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <form action="{{ route('product.update',['product'=>$product->slug]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row justify-content-around">
            <div class="col-12 col-md-5">
                <div class="form-group">
                    <label class="col-form-label" for="created_at"><b>Date created :</b> </label>
                    {{ $product['created_at'] }}
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="name">full name :</label>
                    <input class="form-control" type="text" id="name" name="name"
                           value="{{ $product['name'] }}">
                </div>
                <div class="form-group">
                    <label>brand :</label>
                    <select class="select2 form-control" tabindex="-1" name="brand">
                        <option {{old("brand") ? "selected" : ''}} value=""></option>
                        @foreach($brands as $brand)
                            <option {{ ($product['brand_id'] == $brand['id'] ? "selected":"") }} value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <label for="category">select category :</label>
                    <select class="select2 select form-control" id="category" name="category[]" multiple>
                        @foreach($categories as $category)
                            <option {{ (in_array($category['slug'], $product['categories']->pluck('slug')->toarray()) ? "selected":"") }} value="{{ $category['id'] }}">{{ $category['slug'] }}
                                &nbsp;&nbsp;&nbsp;
                            </option>
                        @endforeach
                    </select>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <label for="description">description :</label>
                    <textarea class="form-control" name="description" id="description" cols="30"
                              rows="10">{{ $product['description'] }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="form-group">
                    <label class="col-form-label" for="created_at"><b>Last update :</b> </label>
                    {{ $product['updated_at'] }}
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="old_price">old_price :</label>
                    <input class="form-control" type="text" id="old_price" name="old_price"
                           value="{{ $product['old_price'] }}">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="new_price">new price :</label>
                    <input class="form-control" type="text" id="new_price" name="new_price"
                           value="{{ $product['new_price'] }}">
                </div>
                <div class="col-12 col-md-6 mt-5 mb-3">
                    <div class="imageupload">
                        <div class="file-tab">
                            @if($product['img'])
                                <img src="{{ url($product->img) }}" alt="Image preview" id="preview_image"
                                     class="thumbnail" style="height:auto;width:100%">
                            @else
                                <img src="{{ url('images/profile.png') }}" alt="Image preview" id="preview_image"
                                     class="thumbnail" style="height:auto;width:100%">
                            @endif
                            <label class="btn btn-default btn-file">choose poster image<input type="file" name="img"
                                                                                              id="cropper">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 mt-2 mb-3">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="status1" name="status" class="custom-control-input"
                               value="1"{{ ( $product['status']  == 1 ?  "checked" : '') }}>
                        <label class="custom-control-label" for="status1">published</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="status2" name="status" class="custom-control-input"
                               value="2"{{ ( $product['status']  == 2 ?  "checked" : '') }}>
                        <label class="custom-control-label" for="status2">draft</label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <hr>
        <div class="col-12">
            <h4>Add more picture to Gallery</h4>
            <div class="form-group">
                <label for="gallery">gallery :</label>
                <input class="form-control btn btn-info pb-4" type="file" id="gallery" name="gallery[]" value="{{ old("gallery") }}" multiple>
            </div>
        </div>

        <div class="col-12 col-md-5">
            <button type="submit" class="btn btn-warning">update</button>
            <a href="{{route('product.index')}}" class="btn btn-info">return</a>
        </div>
    </form>

    <hr>
    <hr>
    <div class="row no-gutters">
        <h1>Galleries of Product {{ $product->name }}</h1>
        <form action="{{ route('product.destroy', ['product' => $product->slug]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="roe no-gutters">
                @foreach($product->galleries as $picture)
                    <div class="d-inline-block m-3">
                        <input type="checkbox" name="selected[]" value="{{ $picture['id'] }}">
                        <img src="{{ url($picture->img) }}" class="image" alt="">
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-danger"
                    onclick="confirm('are you sure to delete') ? submit() : false;">delete <i class="fa fa-trash-o"></i>
            </button>
        </form>
    </div>
@endsection
