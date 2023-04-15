@php
	$featureProductContent = getContent('featured_product.content',true);
    $featuredProducts = \App\Models\Product::whereHas('category', function ($query) {
                    $query->where('status',1);
                })->where('featured',1)->with(['category'])->limit(12)->latest()->get();
@endphp

@if (count($featuredProducts) > 0)
    <section class="pb-50">
        <div class="container">
            <div class="section-header section-header--style">
            <h2 class="section-title">{{__(@$featureProductContent->data_values->heading)}}</h2>
            </div>
            <div class="featured-product-slider">

                @foreach($featuredProducts as $item)
                    <div class="single-slide">
                        <div class="product-card style--two">
                            <div class="product-card__thumb">
                                <a href="{{route('product.details',$item->id)}}" class="d-block">
                                <img src="{{ getImage(imagePath()['p_image']['path'].'/'. $item->image,imagePath()['p_image']['size'])}}" alt="@lang('image')" class="rounded-3">
                                </a>
                            </div>
                            <div class="product-card__content">
                                <h4 class="title"><a href="{{route('product.details',$item->id)}}">{{__($item->name)}}</a></h4>
                                <div class="details mt-2">
                                <div class="left">
                                    <div class="ratings">
                                        @for ($i = 0; $i < $item->rating; $i++)
                                            <i class="las la-star"></i>
                                        @endfor

                                        @for ($i = 0; $i < 5-$item->rating; $i++)
                                            <i class="lar la-star"></i>
                                        @endfor
                                        <span>({{$item->response}})</span>
                                    </div>
                                </div>
                                <div class="right">
                                    <p class="sale-text"><i class="las la-cloud-download-alt"></i> <span>{{$item->total_download}}</span></p>
                                </div>
                                </div>
                            </div>
                        </div><!-- product-card end -->
                    </div><!-- single-slide end -->
                @endforeach
            </div><!-- featured-product-slider end -->
            <div class="text-center mt-5">
                <a href="{{route('featured.products')}}" class="btn btn-md px-4 btn-outline--base">@lang('View All')</a>
            </div>
        </div>
    </section>
@endif
