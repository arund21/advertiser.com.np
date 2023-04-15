@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
	$bannerContent = getContent('banner.content',true);
@endphp
    <!-- hero section start -->
    <section class="hero bg_img" style="background-image: url({{ getImage('assets/images/frontend/banner/'. @$bannerContent->data_values->image,'1920x900') }});">
    <div class="full-wh">
        <div class="bg-animation">
            <div id='stars'></div>
            <div id='stars2'></div>
            <div id='stars3'></div>
            <div id='stars4'></div>
        </div>
    </div>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 text-center">
            <h2 class="hero__title">{{__(@$bannerContent->data_values->heading)}}</h2>
            <p class="hero__description">{{__(@$bannerContent->data_values->sub_title)}}</p>
            </div>
        </div><!-- row end -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
            <form class="header-search-form" action="{{route('product.search')}}" method="GET">
                <input type="text" autocomplete="off" name="search" placeholder="@lang('e.g. facebook marketing , web template etc')" class="form--control" required>
                <button type="submit" class="header-search-form__btn"> <i class="las la-search"></i>@lang('Search')</button>
            </form>
            </div>
        </div>
        </div>
    </section>
    <!-- hero section end -->

    <div class="site-body pt-100 pb-100">
        <div class="container-fluid">
            <div class="main-ad-section">

                <div class="main-section main-section-home">

                    @if($sections->secs != null)
                        @foreach(json_decode($sections->secs) as $sec)
                            @include($activeTemplate.'sections.'.$sec)
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
