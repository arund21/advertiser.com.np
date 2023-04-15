@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="main-ad-section">

                <div class="main-section">
                    <div class="row gy-4 justify-content-center">
                        @foreach($blogElements as $item)
                            <div class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6">
                                <div class="blog-card rounded-3">
                                <div class="blog-card__thumb rounded-3">
                                    <img src="{{ getImage('assets/images/frontend/blog/'. @$item->data_values->image,'770x550') }}" alt="@lang('image')" class="rounded-3">
                                </div>
                                <div class="blog-card__content my-3">
                                    <div class="post-meta">
                                    <span class="post-meta__tags me-2">
                                        <i class="fas fa-calendar-week"></i>
                                    </span>
                                    <span class="post-meta__date">{{showDateTime(@$item->data_values->created_at,'d M, Y')}}</span>
                                    </div>
                                    <h3 class="title"><a href="{{ route('blog.details',[$item->id,\Str::slug(__(@$item->data_values->title))]) }}">{{ Str::limit(strip_tags(__(@$item->data_values->title)),80) }}</a></h3>
                                    <a href="{{ route('blog.details',[$item->id,\Str::slug(__(@$item->data_values->title))]) }}" class="btn btn-outline--base btn-sm mt-4">@lang('Read More') <i class="las la-long-arrow-alt-right"></i></a>
                                </div>
                                </div><!-- blog-card end -->
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-12">
                          <ul class="pagination justify-content-center">
                            {{$blogElements->links()}}
                        </ul>
                        </div>
                    </div>
                </div>

                @include($activeTemplate.'partials.right-add')
            </div>
        </div>
    </section>
@endsection
