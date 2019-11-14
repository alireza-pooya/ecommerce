@extends('layouts.panel')
@section('header')
    <title>panel-Contact Us</title>
@endsection
@section('content')
    <h1 class="mb-5 shadow-sm bg-light p-3">show Contact Us</h1>
    @include('layouts.messages')
    @include('layouts.errors')
    <div class="col-12">
        <table class="col-6 justify-content-start table noBorder">
            <tr>
                <td><label for="name" class="title">Name: </label></td>
                <td><span id="name">{{ ( $contact->full_name ?  $contact->full_name : 'empty')  }}</span></td>
            </tr>
            <tr>
                <td><label for="email" class="title">Email: </label></td>
                <td><span id="email">{{ ($contact->email ? $contact->email : 'empty') }}</span></td>
            </tr>
            <tr>
                <td><label for="mobile" class="title">Mobile: </label></td>
                <td><span id="mobile">{{ ($contact->mobile ? $contact->mobile : "empty") }}</span></td>
            </tr>
            <tr>
                <td><label for="mobile" class="title">Mobile: </label></td>
                <td><span id="mobile">{{ ($contact->mobile ? $contact->mobile : "empty") }}</span></td>
            </tr>
        </table>
        <div>
            <label for="body" class="title">Body: </label>
        </div>
        <div>
            <span id="body">{{ ($contact->content ? $contact->content : "empty") }}</span>
        </div>
        <form action="{{route('contact.update',['contact'=>$contact->id])}}" class="pt-2" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <label for="response" class="title">Response :</label>
            <textarea class="form-control mb-3" name="response" id="response" cols="30" rows="10">{!! $contact['response'] !!}</textarea>
            <button type="submit" class="btn btn-warning">send response</button>
            <a href="{{route('contact.index')}}" class="btn btn-info">return</a>
        </form>
    </div>

@endsection