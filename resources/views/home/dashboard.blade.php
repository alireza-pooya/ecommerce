@extends('layouts.homebase')
@section('content')
<? $user = \Illuminate\Support\Facades\Auth::user() ?>
    <div class="container mt-5 shadow form-bg">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="container">
                    <div class="main">
                        <div class="side">
                            <nav class="dr-menu">
                                <div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">Account</a></div>
                                <ul>
                                    <li><a class="dr-icon dr-icon-user" href="#">{{ $user->full_name }}</a></li>
                                    <li><a class="fa fa-user" href="{{ route('profile.edit',['user' => $user->id ]) }}">&nbsp;&nbsp; Edit Profile</a></li>
                                    <li><a class="fa fa-key" href="{{ route('profile.password.change',['user' => $user->id ]) }}">&nbsp;&nbsp; Password</a></li>
                                    <li><a class="fa fa-map" href="{{ route('address.index') }}">&nbsp;&nbsp; My Addresses</a></li>
                                    <li><a class="fa fa-map-pin" href="{{ route('address.create') }}">&nbsp;&nbsp; Add Address</a></li>
                                    <li><a class="fa fa-map-pin" href="{{ route('orders.index') }}">&nbsp;&nbsp; Last Orders</a></li>
                                    <li><a class="dr-icon dr-icon-switch" href="{{ route('logout') }}">&nbsp; Logout</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 mb-5">
                @yield('body')
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            var YTMenu = (function () {
                function init() {
                    [].slice.call(document.querySelectorAll('.dr-menu')).forEach(function (el, i) {
                        var trigger = el.querySelector('div.dr-trigger'),
                            icon = trigger.querySelector('span.dr-icon-menu'),
                            open = false;

                        trigger.addEventListener('click', function (event) {
                            if (!open) {
                                el.className += ' dr-menu-open';
                                open = true;
                            }
                        }, false);

                        icon.addEventListener('click', function (event) {
                            if (open) {
                                event.stopPropagation();
                                open = false;
                                el.className = el.className.replace(/\bdr-menu-open\b/, '');
                                return false;
                            }
                        }, false);

                    });
                }

                init();
            })();
        });
    </script>
@endsection