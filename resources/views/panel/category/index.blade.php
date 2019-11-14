@extends('layouts.panel')
@section('header')
    <title>panel-Category</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Category</h1>
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
    <div class="row justify-content-between">
        <div class="col-12 col-md-5 justify-content-lg-start">
            <form class="shadow-sm bg-light p-5" action="{{ route('category.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="mb-5">
                        <h3>Add New category</h3>
                        <hr>
                    </div>
                    <label for="name">category name :</label>
                    <input type="text" id="name" name="name" placeholder="please enter your new category"
                           class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>select main category :</label>
                    <select class="select2 form-control" tabindex="-1" name="parent_id">
                        <option {{ (!old("parent_id") ? "selected":"") }} value=""></option>
                        @foreach($categories as $category)
                            <option {{ (old("parent_id") == $category['id'] ? "selected":"") }} value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="focus-border"></span>
                </div>
                <button type="submit" class="btn btn-success">submit</button>
            </form>
        </div>
        <div class="col-12 col-md-5">
            <table class="table border table-striped text-center">
                <h3>List Of Categories</h3>
                <thead>
                <tr>
                    <td><b>name</b></td>
                    <td><b>main category</b></td>
                    <td><b>setting</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td></td>
                        <td><a href="{{route('category.edit',['category'=>$category->slug])}}" class="btn btn-warning">edit
                                <i class="fa fa-pencil-square-o"></i></a></td>
                    </tr>
                    @foreach($category['children'] as $child)
                        <tr>
                            <td>{{ $child->name }}</td>
                            <td>{{$category->name}}</td>
                            <td><a href="{{route('category.edit',['category'=>$child->slug])}}" class="btn btn-warning">edit
                                    <i class="fa fa-pencil-square-o"></i></a></td>
                        </tr>
                    @endforeach
                @endforeach

                </tbody>
            </table>
            {{ $categories->render() }}
        </div>

    </div>

@endsection