@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <b>@lang('Product Image')</b>
                                    <div class="image-upload mt-2">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage('/',imagePath()['p_image']['size']) }})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg" required>
                                                <label for="profilePicUpload1" class="bg--success"> @lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg, jpg, png')</b>. @lang('Image will be resized to'): <b>{{imagePath()['p_image']['size']}}</b> @lang('px')</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Product Name')</label>
                                            <input type="text" class="form-control" placeholder="@lang('Enter name')" value="{{ old('name') }}" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Category')</label>
                                            <select name="category_id" class="form-control" required>
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Version')</label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="text" class="form-control" name="version" value="{{ old('version')}}" placeholder="@lang('Enter version')" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Demo Link')</label>
                                            <input type="url" class="form-control" placeholder="@lang('Enter project demo link')" value="{{old('demo_link')}}" name="demo_link" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Rating') <code>[@lang('out of 5')]</code></label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="number" class="form-control" name="rating" value="{{old('rating')}}" placeholder="@lang('Enter rating')" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Total Response')</label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="number" class="form-control" name="response" value="{{old('response')}}" placeholder="@lang('Enter response')" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('Upload / Link')</label>
                                            <select name="upload_system" id="upload-system" class="form-control" required>
                                                <option value="1">@lang('File Upload')</option>
                                                <option value="2">@lang('Download Link')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="upload-file">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="upload-link">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold" class="form-control-label font-weight-bold">@lang('HTML Description')</label>
                                    <small><code>(@lang('HTML or plain text allowed'))</code></small>
                                    <textarea name="description" class="form-control nicEdit" rows="15" placeholder="@lang('Enter your message')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{route('admin.product.all')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw la-backward"></i> @lang('Go Back') </a>
@endpush

@push('script')
<script>
    'use strict';

    (function ($) {
        $('select[name="upload_system"]').on('change', function(){

            var fileUploadSystem = $(this).find('option:selected').val();
            var fileDiv = `<div class="form-group">
                                <label class="form-control-label font-weight-bold" class="form-control-label font-weight-bold">@lang('Upload File')</label>
                                <input type="file" name="file" class="form-control" accept=".zip" required>
                            </div>`;

            var linkDiv = `<div class="payment-method-item p-2">
                                <div class="payment-method-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card border--primary">
                                                <h5 class="card-header bg--primary  text-white">@lang('Add Download Links')
                                                    <button type="button" class="btn btn-sm btn-outline-light float-right addUserData"><i class="la la-fw la-plus"></i>@lang('Add New')
                                                    </button>
                                                </h5>

                                                <div class="card-body addedField">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group mb-md-0">
                                                                    <input type="url" name="links[]" class="form-control" type="text" placeholder="@lang('Enter valid url')" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

            if (fileUploadSystem == 1) {
                $('.upload-file').html(fileDiv);
                $('.upload-link').html('');
            }

            if (fileUploadSystem == 2) {
                $('.upload-link').html(linkDiv);
                $('.upload-file').html('');
            }

            $('.addUserData').on('click', function () {
                var html = `<div class="row user-data">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <div class="input-group mb-md-0">
                                            <input type="url" name="links[]" class="form-control" type="text" placeholder="@lang('Enter valid url')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                            <button class="btn btn--danger btn-lg removeBtn w-100 mt-28 text-center" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                    <div class="form-group">
                                </div>
                            </div>`;
                $('.addedField').append(html)
            });
            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });
        }).change();


    })(jQuery);
</script>
@endpush


