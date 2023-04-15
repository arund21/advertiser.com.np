@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Category')</th>
                                    <th scope="col">@lang('Download')</th>
                                    <th scope="col">@lang('Featured')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($products as $item)
                                    <tr>
                                        <td data-label="@lang('Name')">{{ $item->name }}</td>
                                        <td data-label="@lang('Category')">{{ $item->category->name }}</td>
                                        <td data-label="@lang('Download')">{{$item->total_download}}</td>
                                        <td data-label="@lang('Featured')">
                                            @if ($item->featured == 1)
                                                <span class="badge badge--primary">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            @if ($item->featured == 1)
                                                <a href="#0" class="icon-btn bg--warning" data-toggle="modal" data-target="#unFeaturedModal{{$loop->index}}"><i class="las la-haykal"></i></a>
                                            @else
                                                <a href="#0" class="icon-btn bg--success" data-toggle="modal" data-target="#featuredModal{{$loop->index}}"><i class="las la-haykal"></i></a>
                                            @endif
                                            <a href="{{route('admin.product.edit',$item->id)}}" class="icon-btn "><i class="la la-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" data-id="{{ $item->id }}" class="icon-btn btn--danger ml-1 removeModalBtn" data-toggle="tooltip" data-original-title="@lang('Remove')"> <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                        <div id="featuredModal{{$loop->index}}" class="modal fade" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">@lang('Make Featured Confirmation')</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.featured.product') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <div class="modal-body">
                                                            <p>@lang('Are you sure to make this product featured?')</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                                                            <button type="submit" class="btn btn--primary">@lang('Make Featured')</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="unFeaturedModal{{$loop->index}}" class="modal fade" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text--danger">@lang('Make Unfeatured Confirmation')</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.unfeatured.product') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <div class="modal-body">
                                                            <p>@lang('Are you sure to make this product unfeatured?')</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                                                            <button type="submit" class="btn btn--danger">@lang('Make Unfeatured')</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $products->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
    {{-- Remove Product MODAL --}}
    <div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Product Removal Confirmation!')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.product.remove') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="product_id">
                        <p><span class="font-weight-bold"></span> @lang('Are you sure yo remove this product')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Remove')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{route('admin.product.new')}}" class="btn btn--primary mr-3 mt-2"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
    <form action="" method="GET" class="form-inline float-sm-right bg--white mt-2">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Product/Category name')" value="{{$search ?? ''}}" autocomplete="off">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $('.removeModalBtn').on('click', function() {
                $('#removeModal').find('input[name=product_id]').val($(this).data('id'));
                $('#removeModal').modal('show');
            });
        })(jQuery);
    </script>
@endpush
