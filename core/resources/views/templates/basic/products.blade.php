@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')
<div class="pt-50 pb-50">
    <div class="container">
      <div class="main-ad-section">

        <div class="main-section">

            <div class="row gy-4 justify-content-center">
                @forelse($products as $item)
                    <div class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6">
                        <div class="product-card">
                            <div class="product-card__thumb">
                                <a href="{{route('product.details',$item->id)}}" class="d-block">
                                <img src="{{ getImage(imagePath()['p_image']['path'].'/'. $item->image,imagePath()['p_image']['size'])}}" alt="image" class="rounded-3">
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
                                        <p class="sale-text"><b>{{$item->total_download}}</b> @lang('sales')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card__footer">
                                <div class="left">
                                <img src="{{ getImage(imagePath()['category']['path'].'/'. $item->category->image,imagePath()['category']['size'])}}" alt="image">
                                <a href="{{route('category.search',$item->category->id)}}" class="category">{{$item->category->name}}</a>
                                </div>
                                <div class="right">
                                <a href="{{$item->demo_link}}" class="btn btn-sm btn--base">@lang('Live Demo')</a>
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
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                  <ul class="pagination justify-content-center">
                    {{$products->links()}}
                </ul>
                </div>
            </div>
        </div>

        @include($activeTemplate.'partials.right-add')
      </div>
    </div>
  </div>
@endsection
