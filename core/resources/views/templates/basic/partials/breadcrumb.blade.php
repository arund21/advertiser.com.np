@php
    $breadcrumbContent = getContent('breadcrumb.content',true);
@endphp
<section class="inner-page-hero bg_img" style="background-image: url({{ getImage('assets/images/frontend/breadcrumb/'. @$breadcrumbContent->data_values->image,'1920x900') }});">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2 class="page-title">{{__($pageTitle)}}</h2>
          <ul class="page-list justify-content-center">
            <li><a href="{{route('home')}}">@lang('Home')</a></li>
            <li class="active">{{__($pageTitle)}}</li>
          </ul>
        </div>
      </div>
    </div>
</section>
