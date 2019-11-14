@extends('layouts.panel')
@section('header')
    <title>panel-SlideShow</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Top Brand</h1>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="row justify-content-between">
        <div class="col-12 col-md-5 justify-content-lg-start">
            <form class="shadow-sm bg-light p-5" action="{{ route('topbrand.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="mb-5">
                        <h3>Add New Brand</h3>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="image">Image :</label>
                        <input type="file" id="image" name="image" class="form-control" placeholder="choose image">
                    </div>
                    <div class="form-group">
                        <label for="link">Link :</label>
                        <input type="text" id="link" name="link" placeholder="please enter link" class="form-control"
                               value="{{ old('link') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">submit</button>
            </form>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{ route('topbrand.destroy', ['topBrand' => 'destroy']) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <table class="table border table-striped">
                    <h3>Top Brands</h3>
                    <thead>
                    <tr>
                        <td>#</td>
                        <td><b>image</b></td>
                        <td><b>link</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topBrands as $topBrand)
                        <tr>
                            <td class="a-center" id="icheck">
                                <input type="checkbox" name="selected[]" value="{{ $topBrand['id'] }}">
                            </td>
                            <td><img src="{{ url( $topBrand->image ) }}" style="height: 100px ; width: 100px;" alt=""></td>
                            <td>{{\Illuminate\Support\Str::limit($topBrand['link'],40)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-danger" onclick="confirm('are you sure to delete') ? submit() : false;"><i class="fa fa-trash-o"></i>delete  <i class="fa fa-trash"></i></button>
            </form>
        </div>
    </div>
@endsection