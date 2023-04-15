@php
	$blogContent = getContent('blog.content',true);
	$blogElements = getContent('blog.element',false,3);
@endphp

<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="section-header text-center">
            <h2 class="section-title">{{__(@$blogContent->data_values->heading)}}</h2>
            <p class="mt-3">{{__(@$blogContent->data_values->sub_title)}}</p>
            </div><!-- section-header end -->
        </div>
        </div><!-- row end -->
        <div class="row gy-4 justify-content-center">
            @foreach($blogElements as $item)
                <div class="col-xl-4 col-lg-4 col-sm-6">
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

        <div class="text-center mt-5">
            <a href="{{route('blogs')}}" class="btn btn-outline--base">@lang('View All')</a>
        </div>
    </div>
</section>
