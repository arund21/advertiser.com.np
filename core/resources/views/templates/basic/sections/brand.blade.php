@php
    $brandContent = getContent('brand.content',true);
    $brandElements = getContent('brand.element',false);
@endphp

<div class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="section-header text-center">
            <h2 class="section-title">{{__(@$brandContent->data_values->heading)}}</h2>
            <p class="mt-2">{{__(@$brandContent->data_values->sbu_title)}}</p>
            </div>
        </div>
        </div><!-- row end -->
        <div class="brand-slider">
            @foreach($brandElements as $item)
                <div class="single-slide">
                    <div class="brand-item">
                    <img src="{{ getImage('assets/images/frontend/brand/'. @$item->data_values->image,'230x130') }}" alt="@lang('image')">
                    </div><!-- brand-item end -->
                </div><!-- single-slide end -->
            @endforeach
        </div>
    </div>
</div>
