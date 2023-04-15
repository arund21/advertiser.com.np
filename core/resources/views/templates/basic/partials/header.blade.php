<header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-9">
            <ul class="header-menu-list justify-content-sm-start justify-content-center">
              <li>
                <a href="{{route('home')}}">@lang('Home')</a>
              </li>
              <li>
                <a href="{{route('products')}}">@lang('Products')</a>
              </li>
              <li>
                <a href="{{route('blogs')}}">@lang('Blogs')</a>
              </li>
                @foreach($pages as $k => $data)
                    <li>
                        <a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a>
                    </li>
                @endforeach
              <li>
                <a href="{{route('contact')}}">@lang('Contact')</a>
              </li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-3">
            <div class="d-flex flex-wrap align-items-center justify-content-sm-end justify-content-center">
              <!--<select name="site-language" class="language-select langSel">-->
              <!--  @foreach($language as $item)-->
              <!--      <option value="{{ __($item->code) }}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>-->
              <!--  @endforeach-->
              <!--</select>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="background-color:#f4f4f4;" class="header__bottom">
      <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
          <a class="site-logo site-title" href="{{route('home')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu ms-auto">


                @foreach ($categories->take(6) as $item)
                    <li>
                        <a href="{{route('category.search',$item->id)}}">{{__($item->name)}}</a>
                    </li>
                @endforeach

                @if (count($categories) > 6)
                    <li class="menu_has_children">
                        <a href="#0">@lang('More')</a>
                        <ul class="sub-menu">
                            @foreach ($categories->skip(6) as $item)
                                <li><a href="{{route('category.search',$item->id)}}">{{__($item->name)}}</a></li>
                            @endforeach

                        </ul>
                    </li>
                @endif
            </ul>
          </div>
        </nav>
      </div>
    </div>
</header>

<div class="full-wh">
    <!-- STAR ANIMATION -->
    <div class="bg-animation">
        <div id='stars'></div>
        <div id='stars2'></div>
        <div id='stars3'></div>
        <div id='stars4'></div>
    </div><!-- / STAR ANIMATION -->
</div>