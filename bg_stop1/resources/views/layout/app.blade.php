<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- <title>App Name - yield('title')</title> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="fb:app_id"          content="1234567890" />
    <meta property="og:type"            content="article" />
    <meta property="og:url"             content="https://bgstop.co.uk" />
    <meta property="og:title"           content="BGSTOP" />
    <meta property="og:image"           content="https://bgstop.co.uk/img/bg_stop_logo_black.png" />
    <meta property="og:description"    content="Мултифункционален уеб сайт
в който хората живеещи в Обединеното
кралство могат да намерят работа, да продадат,
да наемат, да вземат уроци, да се
запознават, да общуват на форум и създавайки
усещането, че сте в едно българско общество, което е далеч от родината." />


    <title>bgstop</title>
    <meta name="description" content="Мултифункционален уеб сайт
в който хората живеещи в Обединеното
кралство могат да намерят работа, да продадат,
да наемат, да вземат уроци, да се
запознават, да общуват на форум и създавайки
усещането, че сте в едно българско общество, което е далеч от родината.">
    <meta name="keywords" content="uk, bg, immigrants, work, purchase, rent, housing, forum, bgforum, bgukforum, dating, english, bulgarian, community, bgstop, lessons, services">


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    @auth
    <script>

        var user = '{!! json_encode( Auth()->user()->id ) !!}';

    </script>
    @endauth
    <style>
        /*body { white-space: nowrap; }*/
        /*div{display:inline-block}*/
    </style>
</head>
{{ config('app.title') }}
<body class="text-center" style="width:1200px;white-space: nowrap;margin:auto;">
<div id="wrapper" class="text-center"   >
    <header>
        <div class="col-xs-4">

            @auth
            @include('messages.contactsManager')
            @include('messages.chat')
            @endauth

            <div class="col-xs-12">
                <img src="/img/bgflag.jpg" height="190" width="190" alt="bg_stop_Zimg"/>
            </div>
        </div>
        <div class="col-xs-4">

            <div class="logoHookParent">
                <a href="/">
                    <img src="/img/bg_stop_logo_black.png" alt="bg_stop">
                </a>
            </div>
            {{--<div class="col-xs-6">--}}
            {{--времето тук--}}
            {{--</div>--}}
            {{--<div class="col-xs-6">--}}
            {{--валутата тук--}}
            {{--</div>--}}
        </div>
        <div class="col-sm-4 mailbox">
            @include('messages.messages')
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



    @include('inc.nav')
    <!--<img class="dropDownButton" src="/img/stop.png"/>-->
    </header>
    <div style="width:100%;float:left;clear:both;">
        <div style="width:200px;display:inline-block;float:left">
            <img src="/img/repair.png" style="width:200px;height:200px">
            <br>
            <br>
            <img src="/img/taxi.png" style="width:200px;height:200px">
        </div>
        <div style="width:200px;float:right;">
            <img src="/img/builders.png" style="width:300px;height:300px">
            <br>
            <br>
            <img src="/img/electrician.png" style="width:300px;height:300px">
        </div>
        <div class="container" style="width:800px;display:inline-block;overflow:visible;white-space:normal">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="/img/webandapp.png" style="width:100%;height:300px!important">
                    </div>
                    <div class="item">
                        <img src="/img/advenci.png" style="width:100%;height:300px!important">
                    </div>
                    <div class="item">
                        <a href="http://www.commercialclean4you.co.uk/"><img src="/img/cleaning.png" style="width:100%;height:300px!important;"></a>
                    </div>
                    <div class="item">
                        <img src="/img/addani.png" style="width:100%;height:300px!important">
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
        <!--                <div class="container" style="width:800px;display:inline-block;overflow:visible;white-space:normal">-->
            <!--<div id="myCarousel" class="carousel slide" data-ride="carousel">-->
            <!-- Indicators -->
            <!--<ol class="carousel-indicators">-->
            <!--    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
            <!--    <li data-target="#myCarousel" data-slide-to="1"></li>-->
            <!--    <li data-target="#myCarousel" data-slide-to="2"></li>-->
            <!--</ol>-->

            <!-- Wrapper for slides -->
            <!--<div class="carousel-inner">-->
            <!--    <div class="item active">-->
            <!--        <img src="/img/webandapp_bg.png" style="width:100%;height:300px!important">-->
            <!--    </div>-->
            <!--        <div class="item">-->
            <!--        <img src="/img/advenci.png" style="width:100%;height:300px!important">-->
            <!--    </div>-->
            <!--    <div class="item">-->
            <!--        <img src="/img/addani.png" style="width:100%;height:300px!important">-->
            <!--    </div>-->
            <!--</div>-->

            <!-- Left and right controls -->
            <!--<a class="left carousel-control" href="#myCarousel" data-slide="prev">-->
            <!--    <span class="glyphicon glyphicon-chevron-left"></span>-->
            <!--    <span class="sr-only">Previous</span>-->
            <!--</a>-->
            <!--<a class="right carousel-control" href="#myCarousel" data-slide="next">-->
            <!--    <span class="glyphicon glyphicon-chevron-right"></span>-->
            <!--    <span class="sr-only">Next</span>-->
            <!--</a>-->
            <!--</div>-->
        </div>
        {{--<div style="width:200px;float:right;">--}}
        {{--<img src="/img/builders.png" style="width:300px;height:300px">--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<img src="/img/electrician.png" style="width:300px;height:300px">--}}
        {{--</div>--}}
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
