@php
    $socialIconElements = getContent('social_icon.element',false,4);
    $policyElements = getContent('policy.element',false,4);
@endphp
<footer class="footer">
    <div class="footer__top">
      <div class="container">
        <div class="footer-info-area">
          <div class="row justify-content-between">
            <div class="col-lg-2 text-lg-start text-center">
              <a href="#0" class="footer-logo"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')"></a>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
              <div class="row gy-4">
                <div class="col-sm-4 footer-info-item">
                  <h4 class="footer-info-number">{{$totalProduct}}</h4>
                  <p class="caption">@lang('Total Products')</p>
                </div>
                <div class="col-sm-4 footer-info-item">
                  <h4 class="footer-info-number">{{$totalDownload}}</h4>
                  <p class="caption">@lang('Total Downloads')</p>
                </div>
              </div>
            </div>
          </div>
        </div><!-- footer-info-area end -->
        <div class="row gy-5">
          <div class="col-lg-3 col-sm-6">
            <div class="footer-widget">
              <h3 class="footer-widget__title">@lang('Browse Categories')</h3>
              <ul class="footer-menu-list">
                  @foreach ($categories->take(4) as $item)
                    <li><a href="{{route('category.search',$item->id)}}">{{__($item->name)}}</a></li>
                  @endforeach
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="footer-widget">
              <h3 class="footer-widget__title">@lang('Quick Links')</h3>
              <ul class="footer-menu-list">
                <li><a href="{{route('home')}}">@lang('Home')</a></li>
                <li><a href="{{route('products')}}">@lang('Products')</a></li>
                <li><a href="{{route('blogs')}}">@lang('Blog')</a></li>
                <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="footer-widget">
              <h3 class="footer-widget__title">@lang('Help & Support')</h3>
              <ul class="footer-menu-list">
                @foreach ($policyElements as $item)
                    <li><a href="{{route('policy',[$item->id,$item->data_values->heading])}}">{{__(@$item->data_values->heading)}}</a></li>
                  @endforeach
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="footer-widget">
              <h3 class="footer-widget__title">@lang('Follow Us')</h3>
              <ul class="footer-social-list">
                @foreach ($socialIconElements as $item)
                    <li>
                        <a href="{{@$item->data_values->url}}">
                            @php echo @$item->data_values->social_icon @endphp
                            <span>{{__(@$item->data_values->title)}}</span>
                        </a>
                    </li>
                @endforeach
              </ul>
            </div><!-- footer-widget end -->
          </div>
        </div><!-- row end -->
      </div>
    </div>
    <div class="footer__bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <p class="text-white">@lang('Copyright © 2021 All Rights Reserved')</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
