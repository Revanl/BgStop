<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
       <!-- <title>App Name - yield('title')</title> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        @auth
            <script>

                var user = '{!! json_encode( Auth()->user()->id ) !!}';

            </script>
         @endauth
    </head>

    <body class="text-center">
        <div id="wrapper" class="text-center">
            <header>
                <div class="col-sm-4">
                    <div class="logoHookParent">
                        <a href="/">
                        <img src="/img/bg_stop_logo.png" alt="bg_stop">
                        </a>
                    </div>
                </div>
                <div class="col-sm-2">

                    {{--<div class="col-xs-6">--}}
                        {{--времето тук--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-6">--}}
                        {{--валутата тук--}}
                    {{--</div>--}}
                </div>
                <div class="col-sm-6">
                    @include('messages.messages')
                    @auth
                        @include('messages.contactsManager')
                        @include('messages.chat')
                    @endauth
                    <div class="flex-center position-ref full-height hideOnMobile">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ url('/') }}">Начало</a>
                                    <a href="{{url('/edit')}}">Редакция</a>
                                    <a href="{{url('logout')}}">Изход</a>
                                @else
                                    <a href="{{ route('login') }}">Вход</a>
                                    <a href="{{ route('register') }}">Регистрация</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>

                    <img class="mainImg" src="/img/uk.jpg"/>

                {{--<a href=" http://www.commercialclean4you.co.uk">--}}
                    {{--<img class="mainImg" src="/img/cleaning.png" alt="bg_stop_Zimg"/>--}}
                {{--</a>--}}
                @include('inc.nav')
                <img class="dropDownButton" src="/img/navbar-slide.png"/>
            </header>
            <div class="col-xs-12">
                <div class="col-xs-2">
                    <img src="/img/adone.png" style="width:200px;height:220px">
                    <br>
                    <br>
                    <img src="/img/adtwo.png" style="width:200px;height:200px">
                </div>
                <div class="container col-xs-8" style="float:right;">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>

</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner">
    <div class="item active">
        <img src="/img/webandapp.png" style="width:100%;height:300px!important">
    </div>
    <div class="item">
        <img src="/img/cleaning.png" style="width:100%;height:300px!important">
    </div>
</div>

<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
</a>
</div>
                    @include('inc.messages')
                    @yield('content')
                    <img src="/img/webandapp.png" style="width:100%;height:300px">
                </div>
                <div class="col-xs-2"  style="height:300px">
                   <img src="/img/builders.png" style="width:100%;height:300px">
                    <br>
                    <br>
                   <img src="/img/electrician.png" style="width:100%;height:300px">
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        {{--<script src="/vendor/unisharp/tinymce/js/tinymce/tinymce.min.js"></script>--}}
        {{--<script>tinymce.init({ selector:'textarea' });</script>--}}
        <script>

            CKEDITOR.replace( 'article-ckeditor'  );
        </script>
    </body>
    <footer>
        {{--<div class="col-xs-6"  style="height:300px">--}}
            {{--<img src="/img/repair.png" style="width:100%;height:400px">--}}
        {{--</div>--}}

        {{--<div class="col-xs-6"  style="height:300px">--}}
            {{--<img src="/img/taxilandscape.jpg" style="width:100%;height:400px">--}}
        {{--</div>--}}
    </footer>
</html>