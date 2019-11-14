@extends('layouts.panel')
@section('header')
    <title>panel-Product</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-6">
            <h1>Create Product</h1>
        </div>
        <div class="col-sm-12 col-md-4">
            <form action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="search...">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" style="border-radius: 0 3px 3px 0"><i
                                    class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="container">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="smartwizard">
                <ul>
                    <li class="mr-5"><a href="#step-1">Step 1<br/><small>Fill items</small></a></li>
                    <li class="mr-5"><a href="#step-2">Step 2<br/><small>Descriptions</small></a></li>
                    <li><a href="#step-3">Step 3<br/><small>Gallery</small></a></li>
                </ul>
                <div class="mt-5">

                    <div id="step-1">
                        <div class="row justify-content-around">
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label class="col-form-label" for="code">Name & model:</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}"
                                       placeholder="please enter product name">
                            </div>
                            <div class="form-group">
                                <label>select brand :</label>
                                <select class="select2 form-control" tabindex="-1" name="brand">
                                    <option {{old("brand") ? "selected" : ''}} value=""></option>
                                    @foreach($brands as $brand)
                                        <option {{ (old("brand") == $brand['id'] ? "selected":"") }} value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                            </div>
                            <div class="form-group">
                                <label>select category :</label>
                                <select class="select2 select form-control" name="category[]" multiple>
                                    @foreach($categories as $category)
                                        <option {{ (old("category") == $category['id'] ? "selected":"") }} value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                            </div>

                        </div>
                        <div class="col-12 col-md-5">

                            <div class="form-group">
                                <label for="old_price">old price :</label>
                                <div class="input-group">
                                    <input type="text" id="old_price" name="old_price" class="form-control"
                                           value="{{ old('old_price') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_price">new price :</label>
                                <div class="input-group">
                                    <input type="text" id="new_price" name="new_price" class="form-control"
                                           value="{{ old('new_price') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="img">poster :</label>
                                <input class="form-control" type="file" id="img" name="img" value="{{ old('img') }}">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="step-2" class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="description">description :</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="8" > {{ old('description') }} </textarea>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mr-5">
                            <input type="radio" id="customRadio9" name="status" class="custom-control-input" checked value="1">
                            <label class="custom-control-label" for="customRadio9">ready to publish</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio10" name="status" class="custom-control-input" value="2">
                            <label class="custom-control-label" for="customRadio10">draft</label>
                        </div>
                    </div>
                    <div id="step-3" class="">
                        <h3>please choose product pictures for gallery</h3>
                        <div class="form-group">
                            <label for="gallery">gallery :</label>
                            <input class="form-control btn btn-info pb-4" type="file" id="gallery" name="gallery[]" value="{{ old("gallery") }}" multiple>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg mt-5">create product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


