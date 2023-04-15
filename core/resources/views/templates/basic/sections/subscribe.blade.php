@php
    $subscribeContent = getContent('subscribe.content',true);
@endphp


<!-- subscribe section start -->
<section class="pt-50 pb-50">
    <div class="container">
        <div class="subscribe-wrapper text-center">
            <div class="row justify-content-center">
            <div class="col-xxl-6">
                <h2 class="title text-white">{{__(@$subscribeContent->data_values->heading)}}</h2>
                <p class="mt-3 text-white">{{__(@$subscribeContent->data_values->sub_title)}}</p>
            </div>
            <div class="col-xxl-8 col-xl-12 col-lg-10 mt-5">
                <form class="subscribe-form">
                    <input type="email" name="email" id="subscriber" class="form--control" placeholder="@lang('Email address')">
                    <button class="subscribe-form-btn subs" type="button"><i class="lab la-telegram-plane"></i></button>
                </form>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- subscribe section end -->

@push('script')
    <script>

        'use strict';
        $('.subs').on('click',function () {

            var email = $('#subscriber').val();
            var csrf = '{{csrf_token()}}'

            var url = "{{ route('subscriber.store') }}";
            var data = {email:email, _token:csrf};

            $.post(url, data,function(response){

                if(response.email){
                    $.each(response.email, function (i, val) {
                    iziToast.error({
                    message: val,
                    position: "topRight"
                    });
                    });
                } else{
                    iziToast.success({
                    message: response.success,
                    position: "topRight"
                    });
                }
            });

        });

    </script>

@endpush
