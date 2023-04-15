@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')

<section class="blog-details-section pt-120 pb-120">
    <div class="container">
        <div class="main-ad-section">

            <div class="main-section">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="blog-details-wrapper">
                        <div class="blog-details__thumb">
                          <img src="{{ getImage('assets/images/frontend/blog/'.@$blog->data_values->image,'770x550') }}" alt="@lang('image')">
                          <div class="post__date">
                            <span class="date">{{showDateTime(@$blog->data_values->created_at,'d')}}</span>
                            <span class="month">{{showDateTime(@$blog->data_values->created_at,'M')}}</span>
                          </div>
                        </div><!-- blog-details__thumb end -->
                        <div class="blog-details__content">
                          <h4 class="blog-details__title mb-4">{{__(@$blog->data_values->title)}}</h4>
                          @php echo __(@$blog->data_values->description_nic) @endphp
                        </div><!-- blog-details__content end -->
                        <div class="blog-details__footer">
                          <h4 class="caption">@lang('Share This Post')</h4>
                          <ul class="social__links">
                            <li><a href="http://www.facebook.com/sharer.php?u={{urlencode(url()->current())}}&p[title]={{str_slug(@$blog->data_values->title)}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="http://twitter.com/share?text={{str_slug(@$blog->data_values->title)}}&url={{urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="http://pinterest.com/pin/create/button/?url={{urlencode(url()->current()) }}&description={{str_slug(@$blog->data_values->title)}}"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(url()->current()) }}&title={{str_slug(@$blog->data_values->title)}}"><i class="fab fa-linkedin-in"></i></a></li>
                          </ul>
                        </div><!-- blog-details__footer end -->
                      </div><!-- blog-details-wrapper end -->

                      <div class="comments-area">
                        <h3 class="title">@lang('All Comments')</h3>
                        <div class="fb-comments w-100" data-href="{{ url()->current() }}" data-numposts="5"></div>

                      </div><!-- comments-area end -->
                    </div>
                    <div class="add-section mt-5">
                        <div class="container">
                            <div class="add-thumb text-center">
                                @php echo advertisements('728x90') @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include($activeTemplate.'partials.right-add')
        </div>
    </div>
  </section>
@endsection

@push('fbComment')
	@php echo loadFbComment() @endphp
@endpush

@push('shareImage')
	<meta property="og:image:type" content="{{ getImage('assets/images/frontend/blog/'.@$blog->data_values->image,'770x550') }}" />
@endpush
