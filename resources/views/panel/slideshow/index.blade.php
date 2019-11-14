@extends('layouts.panel')
@section('header')
    <title>panel-SlideShow</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>SlideShow</h1>
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
            <form class="shadow-sm bg-light p-5" action="{{ route('slideshow.store') }}" method="post"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="mb-5">
                        <h3>Add New SlideShow</h3>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="title">Title :</label>
                        <input type="text" id="title" name="title" placeholder="please enter slide show title"
                               class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="body">Body :</label>
                        <textarea class="form-control" name="body" id="body" rows="5"
                                  placeholder="please enter body">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link :</label>
                        <input type="text" id="link" name="link" placeholder="please enter link" class="form-control"
                               value="{{ old('link') }}">
                    </div>
                    <div class="form-group">
                        <label for="start_show">Start From :</label>
                        <input type="text" id="start_show" name="start_show" class="form-control"
                               value="{{ old('start_show') }}">
                    </div>
                    <div class="form-group">
                        <label for="end_show">Expire Date :</label>
                        <input type="text" id="end_show" name="end_show" class="form-control"
                               value="{{ old('end_show') }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image :</label>
                        <input type="file" id="image" name="image" class="form-control" placeholder="choose image">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">submit</button>
            </form>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{ route('slideshow.destroy', ['slideshow' => 'destroy']) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <table class="table border table-striped">
                    <h3>Slide Shows</h3>
                    <thead>
                    <tr>
                        <td>#</td>
                        <td><b>Title</b></td>
                        <td><b>Body</b></td>
                        <td><b>Start From</b></td>
                        <td><b>Expire Date</b></td>
                        <td><b>setting</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slideshows as $slideshow)
                        <tr>
                            <td class="a-center" id="icheck">
                                <input type="checkbox" name="selected[]" value="{{ $slideshow['id'] }}">
                            </td>
                            <td>{{$slideshow->title}}</td>
                            <td>{{\Illuminate\Support\Str::limit($slideshow['body'],10)}}</td>
                            <td>{{$slideshow->start_show}}</td>
                            <td>{{$slideshow->end_show}}</td>

                            <td><a href="{{route('slideshow.edit',['slideShow'=>$slideshow->id ])}}"
                                   class="btn btn-warning">edit <i class="fa fa-pencil-square-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-danger" onclick="confirm('are you sure to delete') ? submit() : false;"><i class="fa fa-trash-o"></i>delete  <i class="fa fa-trash"></i></button>

            </form>
            {{ $slideshows->render() }}
        </div>

    </div>

@endsection