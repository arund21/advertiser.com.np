<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0, shrink-to-fit=no">
    <title> {{ $general->sitename(__($pageTitle)) }}</title>

    @include('partials.seo')

    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap.min.css')}}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/all.min.css')}}">
    <!-- lineawesome font -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lightcase.css')}}">
    <!-- slick slider css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/slick.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
    <!-- site color -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php?color1='.$general->base_color)}}">

    @stack('style-lib')

    @stack('style')
</head>

<body>

    @stack('fbComment')

    <div class="preloader">
        <div class="preloader-container">
        <span class="animated-preloader"></span>
        </div>
    </div>

    <!-- scroll-to-top start -->
    <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="las la-angle-double-up"></i>
        </span>
    </div>
    <!-- scroll-to-top end -->

    @php
        $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
    @endphp

    @if(@$cookie->data_values->status && !session('cookie_accepted'))
        <!-- cookie area start -->
        <div class="remove-cookie">
            <div class="cookie-area">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <p class="text-white">{{__(@$cookie->data_values->description)}}</p>
                            <a href="{{ @$cookie->data_values->link }}" class="text--base mt-2">@lang('Privacy Policy')</a>
                        </div>
                        <div class="col-lg-4 cookie-btn text-end">
                            <button type="button" class="btn btn--base cookie">@lang('Accept')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cookie area end -->
    @endif

    @include($activeTemplate.'partials.header')

    <div class="main-wrapper">
        @yield('content')
    </div>

    @include($activeTemplate.'partials.footer')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- jQuery library -->
    <script src="{{asset($activeTemplateTrue.'js/jquery-3.5.1.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset($activeTemplateTrue.'js/bootstrap.bundle.min.js')}}"></script>
    <!-- slick slider js -->
    <script src="{{asset($activeTemplateTrue.'js/slick.min.js')}}"></script>
    <!-- lightcase js -->
    <script src="{{asset($activeTemplateTrue.'js/lightcase.min.js')}}"></script>
    <!-- main js -->
    <script src="{{asset($activeTemplateTrue.'js/app.js')}}"></script>

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')


    <script>
        (function ($) {
            "use strict";

            $(".langSel").on("change", function() {
                window.location.href = "{{route('home')}}/change/"+$(this).val() ;
            });

            $('.cookie').on('click',function () {
                var url = "{{ route('cookie.accept') }}";

                $.get(url,function(response){

                    if(response.success){
                        notify('success',response.success);
                        $('.remove-cookie').html('');
                    }
                });

            });

            $('.clickUp').on('click',function () {

                var id = $(this).data('id');

                var url = "{{ route('add.clickup') }}";
                var data = {id:id};

                $.get(url, data,function(response){

                    if(response.id){
                        $.each(response.id, function (i, val) {
                            notify('error',val);
                        });
                    }
                });

            });
        })(jQuery);
    </script>

</body>
</html>
