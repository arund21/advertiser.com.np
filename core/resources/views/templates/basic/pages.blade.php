@extends($activeTemplate.'layouts.frontend')

@section('content')
@include($activeTemplate.'partials.breadcrumb')

    <div class="site-body pt-100 pb-100">
        <div class="container-fluid">
            <div class="main-ad-section">

                @include($activeTemplate.'partials.left-add')

                <div class="main-section">

                    @if($sections != null)
                        @foreach(json_decode($sections) as $sec)
                            @include($activeTemplate.'sections.'.$sec)
                        @endforeach
                    @endif
                </div>

                @include($activeTemplate.'partials.right-add')
            </div>
        </div>
    </div>
@endsection
