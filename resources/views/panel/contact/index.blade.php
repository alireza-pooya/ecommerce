@extends('layouts.panel')
@section('header')
    <title>panel-Contact Us</title>
@endsection
@section('content')
    <div class="row justify-content-between bg-light mb-5 shadow-sm p-3">
        <div class="col-sm-12 col-md-4">
            <h1>Contact Us</h1>
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
    @if(count($contacts))
        <div class="row justify-content-between">
            <div class="col-12">
                <form action="{{ route('contact.destroy', ['contact' => 'destroy']) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>List Of Brands</h3>
                    <table class="table border table-striped">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td><b>name</b></td>
                            <td><b>email</b></td>
                            <td><b>message</b></td>
                            <td><b>date</b></td>
                            <td><b>setting</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td class="a-center" id="icheck">
                                    <input type="checkbox" name="selected[]" value="{{ $contact['id'] }}">
                                </td>
                                <td>{{$contact->full_name}}</td>
                                <td>{{$contact->email}}</td>
                                <td> {{\Illuminate\Support\Str::limit($contact['content'],30) }}</td>
                                <td>{{$contact->created_at}}</td>
                                <td><a href="{{route('contact.show',['contact'=>$contact->id])}}"
                                       class="btn @if(empty($contact['response'])) btn-warning @else btn-success @endif">@if(empty($contact['response']))
                                            response @else show @endif</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger" onclick="confirm('are you sure to delete') ? submit() : false;"><i class="fa fa-trash-o"></i>delete  <i class="fa fa-trash"></i></button>
                </form>
                {{ $contacts->render() }}
                @else
                    <h2>Nothing to show</h2>
                @endif
            </div>
        </div>

@endsection