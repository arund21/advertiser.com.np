@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="main-ad-section">

                <div class="main-section">
                    <div class="product-details-header">
                        <h3 class="title">{{__($product->name)}}</h3>
                        <ul class="product-details-meta mt-2">
                        <li><i class="las la-cloud-download-alt"></i> <b class="me-1">{{$product->total_download}}</b> @lang('downloads')</li>
                        <li><i class="las la-list"></i> @lang('Category') - {{__($product->category->name)}}</li>
                        <li><i class="las la-calendar"></i> {{showDateTime($product->created_at, 'd/m/Y')}}</li>
                        </ul>
                    </div><!-- product-details-header end -->
                    <div class="row gx-0 mt-4 product-details-thumb-wrapper">
                        <div class="product-details-thumb-area">
                            <div class="product-details-thumb">
                                <img src="{{ getImage(imagePath()['p_image']['path'].'/'. $product->image,imagePath()['p_image']['size'])}}" alt="image" class="w-100 rounded-3">
                            </div><!-- product-details-thumb end -->
                            <div class="product-details-btn">
                                @if ($product->type == 1)
                                    <a href="{{route('product.download',$product->id)}}" class="btn btn--base">@lang('Download Free')</a>
                                @elseif($product->type == 2)
                                    <a href="#0" class="btn btn--base" data-bs-toggle="modal" data-bs-target="#linkModal">@lang('Download Free')</a>

                                    <div class="modal fade" id="linkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>@lang('Download Links')!</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <ul class="download-links">
                                                                @if ($product->links)
                                                                    @foreach ($product->links as $item)
                                                                        <li><a href="{{$item}}" class="downloadUp" data-id="{{$product->id}}">{{$item}}</a></li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <a href="{{$product->demo_link}}" class="btn btn--base">@lang('Demo Link')</a>
                            </div>
                        </div>
                      </div>
                    <div class="product-details-content mt-5">
                        <div class="mb-4">
                            @php echo $product->description @endphp
                        </div>
                        <div class="add-section mt-5">
                            <div class="container">
                                <div class="add-thumb text-center">
                                    @php echo advertisements('728x90') @endphp
                                </div>
                            </div>
                        </div>

                    </div><!-- product-details-content end -->
                </div>

                @include($activeTemplate.'partials.right-add')
            </div>
        </div>
    </section>

@endsection

@push('script')

<script>
    (function ($) {
        "use strict";

        $('.downloadUp').on('click',function () {

            var id = $(this).data('id');

            var url = "{{ route('download.clickup') }}";
            var data = {id:id};

            $.get(url, data,function(response){

                if(response.id){
                    $.each(response.id, function (i, val) {
                        notify('error',val);
                    });
                }
            });

        });
    })(jQuery);
</script>
@endpush
