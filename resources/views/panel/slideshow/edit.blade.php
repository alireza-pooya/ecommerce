@extends('layouts.panel')
@section('header')
    <title>panel-SlideShow</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Edit Slide Show</h1>
        </div>
    </div>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="row justify-content-between">
        <div class="col-12 col-md-6 justify-content-lg-start">
            <form class="shadow-sm bg-light p-5" action="{{ route('slideshow.update',['slideshow'=>$slideshow->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <div class="mb-5">
                        <h3>Edit <b>{{ $slideshow->title }}</b> SlideShow</h3>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="title">Title :</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $slideshow['title'] }}">
                    </div>
                    <div class="form-group">
                        <label for="body">Body :</label>
                        <textarea class="form-control" name="body" id="body" rows="5">{{ $slideshow->body }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link :</label>
                        <input type="text" id="link" name="link"  class="form-control" value="{{ $slideshow->link }}">
                    </div>
                    <div class="form-group">
                        <label for="start_show">Start From :</label>
                        <input type="text" id="start_show" name="start_show" class="form-control"
                               value="{{ $slideshow->start_show }}">
                    </div>
                    <div class="form-group">
                        <label for="end_show">Expire Date :</label>
                        <input type="text" id="end_show" name="end_show" class="form-control"
                               value="{{ $slideshow->end_show }}">
                    </div>
                    <div class="form-group">
                        <label for="image" class="d-block">Image :</label>
                        <a href="{{ url( $slideshow->image ) }}" target="_blank"><img src="{{ url( $slideshow->image ) }}" width="300px" height="300px"></a>
                        <input type="file" id="image" name="image" class="form-control" placeholder="choose image">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">update</button>
                <a href="{{ route('slideshow.index') }}" class="btn btn-info"> return</a>
            </form>
        </div>
    </div>

@endsection