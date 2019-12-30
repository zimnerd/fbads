@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ __('Campaigns') }}</div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('campaigns.create') }}" class="btn btn-primary m-2 float-right">{{ __('Add Campaign') }}</a>
                            </div>
                            <br>
                            <table class="table table-responsive-sm table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Daily Budget</th>
                                    <th>Impressions</th>
                                    <th>Clicks</th>
                                    <th>CTR</th>
                                    <th>Current Bid</th>
                                    <th>Avg. Bid	Spent</th>
                                    <th>Conv.</th>
                                    <th>Conv. Rate</th>
                                    <th>CPA </th>
                                    <th>Last Update </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaigns as $campaign)
                                    <tr>
                                        <td><strong><a href="{{ url('/campaigns/' . $campaign->id) }}" class="">{{ $campaign->name }}</a></strong></td>
                                        <td><strong>{{ $campaign->id }}</strong></td>
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
                                        <td>
                                            <a href="{{ url('/campaigns/' . $campaign->id . '/edit') }}" class="btn btn-block btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('campaigns.destroy', $campaign->id ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-block btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection

