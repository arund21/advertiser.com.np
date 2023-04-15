@php
	$latestProductContent = getContent('latest_product.content',true);
@endphp

<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="section-header text-center">
            <h2 class="section-title">{{__(@$latestProductContent->data_values->heading)}}</h2>
            <p class="mt-2">{{__(@$latestProductContent->data_values->sub_title)}}</p>
            </div>
        </div>
        </div><!-- row end -->
        <ul class="nav nav-tabs custom--nav-tabs" id="myTab" role="tablist">

        @foreach ($categories as $item)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($loop->index == 0) active @endif" id="{{str_replace(' ','_',strtolower($item->name))}}-tab" data-bs-toggle="tab" data-bs-target="#{{str_replace(' ','_',strtolower($item->name))}}" type="button" role="tab" aria-controls="{{str_replace(' ','_',strtolower($item->name))}}" aria-selected="false">{{__($item->name)}}</button>
            </li>
        @endforeach

        </ul>

        <div class="tab-content mt-4" id="myTabContent">
            @foreach ($categories as $item)
                <div class="tab-pane fade @if($loop->index == 0) show active @endif" id="{{str_replace(' ','_',strtolower($item->name))}}" role="tabpanel" aria-labelledby="{{str_replace(' ','_',strtolower($item->name))}}-tab">
                    <div class="row gy-4 justify-content-center">
                        @forelse($item->products()->limit(6)->get() as $data)
                                <div class="col-xl-4 col-lg-4 col-sm-6">
                                    <div class="product-card">
                                        <div class="product-card__thumb">
                                            <a href="{{route('product.details',$data->id)}}" class="d-block">
                                            <img src="{{ getImage(imagePath()['p_image']['path'].'/'. $data->image,imagePath()['p_image']['size'])}}" alt="image" class="rounded-3">
                                            </a>
                                        </div>
                                        <div class="product-card__content">
                                            <h4 class="title"><a href="{{route('product.details',$data->id)}}">{{__($data->name)}}</a></h4>
                                            <p class="font-size--14px mt-2">{{ Str::limit(strip_tags(__($data->description)),100) }}</p>
                                            <div class="details mt-2">
                                                <div class="left">
                                                    <div class="ratings">
                                                        @for ($i = 0; $i < $data->rating; $i++)
                                                            <i class="las la-star"></i>
                                                        @endfor

                                                        @for ($i = 0; $i < 5-$data->rating; $i++)
                                                            <i class="lar la-star"></i>
                                                        @endfor
                                                    <span>({{$data->response}})</span>
                                                    </div>

                                                </div>
                                                <div class="right">
                                                    <p class="sale-text"><i class="las la-cloud-download-alt"></i> <span>{{$data->total_download}}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-card__footer">
                                            <div class="left">
                                            <img src="{{ getImage(imagePath()['category']['path'].'/'. $item->image,imagePath()['category']['size'])}}" alt="image">
                                            <a href="{{route('category.search',$item->id)}}" class="category">{{$item->name}}</a>
                                            </div>
                                            <div class="right">
                                            <a href="{{$data->demo_link}}" class="btn btn-sm btn--base">@lang('Live Demo')</a>
                                            </div>
                                        </div>
                                    </div><!-- product-card end -->
                                </div>
                        @empty
                            <div class="col-xl-12 col-sm-12">
                                <div class="product-card">
                                    <div class="product-card__content text-center">
                                        <h5 class="title">@lang('No data found')</h5>
                                    </div>

                                </div><!-- product-card end -->
                            </div>
                        @endforelse
                    </div><!-- row end -->
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{route('products')}}" class="btn btn px-4 btn-outline--base">@lang('View All')</a>
        </div>
    </div>
</section>
