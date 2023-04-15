@extends($activeTemplate.'layouts.frontend')
@php
    $contactContent = getContent('contact_us.content',true);
    $contactElements = getContent('contact_us.element',false);
@endphp

@section('content')
@include($activeTemplate.'partials.breadcrumb')

<!-- contact section start -->
<section class="pt-100 pb-100">
    <div class="container">
      <div class="row gy-4 justify-content-center pb-50">
        <div class="col-xl-6">
          <div class="map-wrapper">
            <iframe src = "https://maps.google.com/maps?q={{@$contactContent->data_values->latitude}},{{@$contactContent->data_values->longitude}}&hl=es;z=14&amp;output=embed"></iframe>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="contact-form-wrapper">
            <h2 class="title">{{__(@$contactContent->data_values->title)}}</h2>
            <form method="post" action="">
                @csrf
                <div class="row">
                    <div class="col-lg-12 form-group">
                    <label>@lang('Name')</label>
                    <input type="text" name="name" placeholder="@lang('Enter full name')" class="form--control">
                    </div>
                    <div class="col-lg-12 form-group">
                    <label>@lang('Email')</label>
                    <input type="email" name="email" placeholder="@lang('Enter email address')" class="form--control">
                    </div>
                    <div class="col-lg-12 form-group">
                        <label>@lang('Subject')</label>
                        <input type="text" name="subject" placeholder="@lang('Enter full name')" class="form--control">
                    </div>
                    <div class="col-lg-12 form-group">
                    <label>@lang('Message')</label>
                    <textarea placeholder="@lang('Your message')" name="message" class="form--control"></textarea>
                    </div>
                    <div class="col-lg-12">
                    <button type="submit" class="btn btn--base">@lang('Submit Now')</button>
                    </div>
                </div>
            </form>
          </div><!-- contact-form-wrapper end -->
        </div>
      </div><!-- row end -->
      <h3 class="fw-bold mb-4">{{__(@$contactContent->data_values->contact_title)}}</h3>

      <div class="row gy-4 justify-content-center">

        @foreach($contactElements as $item)
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-info-card__icon">
                    @php echo $item->data_values->icon @endphp
                    </div>
                    <div class="contact-info-card__content">
                    <h4 class="title">{{__(@$item->data_values->title)}}</h4>
                    <a href="tel:548554545">{{__(@$item->data_values->sub_title)}}</a>
                    </div>
                </div><!-- contact-info-card end -->
            </div>
        @endforeach

      </div><!-- row end -->
    </div>
  </section>
  <!-- contact section end -->
@endsection
