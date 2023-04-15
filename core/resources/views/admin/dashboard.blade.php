@extends('admin.layouts.app')

@section('panel')
      @if(@json_decode($general->sys_version)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-right">@lang('Version') {{json_decode($general->sys_version)->version}}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <p><pre  class="f-size--24">{{json_decode($general->sys_version)->details}}</pre></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(@json_decode($general->sys_version)->message)
        <div class="row">
            @foreach(json_decode($general->sys_version)->message as $msg)
              <div class="col-md-12">
                  <div class="alert border border--primary" role="alert">
                      <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                      <p class="alert__message">@php echo $msg; @endphp</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              </div>
            @endforeach
        </div>
        @endif

    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalProduct}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Product')</span>
                    </div>
                    <a href="{{route('admin.product.all')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalFeaturedProduct}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Featured Product')</span>
                    </div>
                    <a href="{{route('admin.product.all')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalDownload}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Download')</span>
                    </div>

                    <a href="{{route('admin.product.all')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--orange b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="la la-envelope"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalCategory}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Category')</span>
                    </div>

                    <a href="{{route('admin.category')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->

    </div><!-- row end-->

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalAdd}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Advertise')</span>
                    </div>
                    <a href="{{route('admin.advertise.all')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalSubscriber}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Subscriber')</span>
                    </div>
                    <a href="{{ route('admin.subscriber.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--pink b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalBlog}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Blog')</span>
                    </div>

                    <a href="#0" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--6 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalPendingTicket}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Pending Ticket')</span>
                    </div>

                    <a href="{{route('admin.ticket.pending')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-30-none mt-5">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-30">
            <div class="chart-area">
                <div class="chart-scroll">
                    <div class="chart-wrapper m-0">
                        <canvas id="myChart" width="400" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')
<!--chart js-->
@php
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $itr = 0;
@endphp

<script src="{{asset('assets/admin/js/vendor/chart.js.2.8.0.js')}}"></script>
<script>
    'use strict';

    var config = {
        type: 'line',
        data: {
            labels: @php echo json_encode($months) @endphp,
            datasets: [{
                label: '@lang('Amount')',
                backgroundColor: '#7367F0',
                borderColor: '#7367F0',
                data: [
                    @foreach($months as $k => $month)
                        @if(@$add_chart_data[$itr]['month'] == $month)
                            {{ @$add_chart_data[$itr]['amount'] }},
                            @php $itr++; @endphp
                        @else
                            0,
                        @endif
                    @endforeach
                ],
                fill: false,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: '@lang('Add Click Data Monthly')'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
                        suggestedMin: 10,

                        // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
                        suggestedMax: 50
                    }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
</script>
@endpush
