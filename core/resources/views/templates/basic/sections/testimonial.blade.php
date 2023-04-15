@php
    $testimonialContent = getContent('testimonial.content',true);
    $testimonialElements = getContent('testimonial.element',false);
@endphp

<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$testimonialContent->data_values->heading)}}</h2>
                    <p class="mt-2">{{__(@$testimonialContent->data_values->sub_title)}}</p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="testimonial-slider">
            @foreach($testimonialElements as $item)
                <div class="single-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-card__content">
                            <p>{{__(@$item->data_values->quote)}}</p>
                        </div>
                        <div class="testimonial-card__client">
                            <div class="thumb">
                                <img src="{{ getImage('assets/images/frontend/testimonial/'. @$item->data_values->image,'255x300') }}" alt="@lang('image')">
                            </div>
                            <div class="content">
                                <h6 class="name">{{__(@$item->data_values->name)}}</h6>
                                <span class="designation">{{__(@$item->data_values->designation)}}</span>
                            </div>
                        </div>
                    </div><!-- testimonial-card end -->
                </div><!-- single-slide end -->
            @endforeach
        </div>
    </div>
  </section>
