@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="mb-5 shadow-lg form-bg">
            <h1 class="text-center pt-5"><b>Contact-Us</b></h1>
            <div class="row no-gutters justify-content-center mt-5">
                <div class="col-12 col-md-4 pb-2 pl-3">
                    <h4><b>Phone Number :</b></h4>
                    +9855551242 <br>
                    +9855551233 <br>
                    +9855551234
                </div>
                <div class="col-12 col-md-4 pl-3">
                    <h4><b>Address:</b></h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos distinctio, inventore labore
                    laudantium libero magni quisquam? Adipisci aperiam
                </div>
            </div>

            <div class="col-8 offset-2 mt-3">
                @include('layouts.messages')
                @include('layouts.errors')
            </div>

            <form action="{{ route('contact.home.store') }}" method="post" class="pb-5">
                {{ csrf_field() }}
                <div class="row no-gutters justify-content-center mt-5">
                    <div class="col-md-4 ml-2">
                        <div class="form-group">
                            <label for="name"><span>*</span>Name :</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="please enter your name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email"><span>*</span>Email :</label>
                            <input class="form-control" type="text" name="email" id="email" placeholder="please enter your email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile :</label>
                            <input class="form-control" type="text" name="mobile" id="Mobile" placeholder="please enter your Mobile" value="{{ old('mobile') }}">
                        </div>
                    </div>
                    <div class="col-md-4 ml-3">
                        <div class="form-group">
                            <div><label for="body"><span>*</span>Message :</label></div>
                            <textarea name="body" id="body" style="width: 100%;" rows="9" placeholder="please leave your message">{{ old('body') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters justify-content-center">
                    <div class="col-4">
                        <button class="form-control btn btn-dark">send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
