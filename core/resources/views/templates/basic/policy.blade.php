@extends($activeTemplate.'layouts.frontend')

@section('content')
@include($activeTemplate.'partials.breadcrumb')

    <!-- privacy section start -->
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="cotent-wrapper">
                        @php
                            echo __(@$policy->data_values->details);
                        @endphp
                    </div><!-- cotent-wrapper end -->
                </div>
            </div>
        </div>
    </section>
    <!-- privacy section end -->

@endsection
