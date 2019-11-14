@extends('layouts.panel')
@section('header')
    <title>panel-Category</title>
@endsection
@section('content')
    <h1 class="mb-5 shadow-sm bg-light p-3">Edit Category</h1>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="col-12 col-md-4 justify-content-lg-start">
        <form action="{{route('category.update',['category'=>$category->slug])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name">category name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}">
            </div>
            <div class="form-group">
                <label>select main category :</label>
                <select class="select2 form-control" tabindex="-1" name="parent_id">
                    <option {{ (!old("parent_id") ? "selected":"") }} value=""></option>
                    @foreach($posts as $value)
                        <option {{ (old("parent_id") == $value['id'] ? "selected":"") }} value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                </select>
                <span class="focus-border"></span>
            </div>
            <button type="submit" class="btn btn-warning">edit <i class="fa fa-pencil-square-o"></i></button>
            <a href="{{route('category.index')}}" class="btn btn-info">return</a>
        </form>
    </div>
@endsection