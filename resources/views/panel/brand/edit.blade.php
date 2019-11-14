@extends('layouts.panel')
@section('header')
    <title>panel-Brand</title>
@endsection
@section('content')
    <h1 class="mb-5 shadow-sm bg-light p-3">Edit Brand</h1>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="col-12 col-md-4 justify-content-lg-start">
        <form action="{{route('brand.update',['brand'=>$brand->id])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name">brand name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $brand->name }}">
            </div>
            <button type="submit" class="btn btn-warning">edit <i class="fa fa-pencil-square-o"></i></button>
            <a href="{{route('brand.index')}}" class="btn btn-info">return</a>
        </form>
    </div>
@endsection