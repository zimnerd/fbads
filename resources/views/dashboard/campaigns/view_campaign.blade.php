@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> <h4>Campaign Name: {{ $campaign->name }}</h4></div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Daily Budget</th>
                                    <th>Impressions</th>
                                    <th>Clicks</th>
                                    <th>CTR</th>
                                    <th>Current Bid</th>
                                    <th>Avg. Bid Spent</th>
                                    <th>Conv.</th>
                                    <th>Conv. Rate</th>
                                    <th>CPA</th>
                                    <th>Last Update</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $campaign->adformat->name }}</td>
                                    <td>
                                  <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>
                                    </td>
                                    <td>{{ $campaign->daily_budget }}</td>
                                    <td><strong>{{ $campaign->impressions }}</strong></td>
                                    <td><strong>{{ $campaign->clicks }}</strong></td>
                                    <td><strong>{{ $campaign->ctr }}</strong></td>
                                    <td><strong>{{ $campaign->current_bid }}</strong></td>
                                    <td><strong>{{ $campaign->average_bid }}</strong></td>
                                    <td><strong>{{ $campaign->conversion }}</strong></td>
                                    <td><strong>{{ $campaign->conversion_rate }}</strong></td>
                                    <td><strong>{{ $campaign->cpa }}</strong></td>
                                    <td><small>{{ $campaign->updated_at }}</small></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> <h4>Creatives</h4></div>
                        <div class="card-body">
                            @foreach($campaign->creative as $creative)
                                <p>{{$creative}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <a href="{{ route('campaigns.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>

        </div>
    </div>

@endsection


@section('javascript')

@endsection
