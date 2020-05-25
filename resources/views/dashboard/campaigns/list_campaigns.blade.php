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
                            <a href="{{ route('campaigns.create') }}" class="btn btn-info m-2 float-right">{{ __('Add Campaign') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-sm table-bordered table-striped">
                            <thead class="bg-dark white-text">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Budget</th>
                                <th>Reach</th>
                                <th>Clicks</th>
                                <th>Location</th>
                                <th>Radius</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Start Date</th>
                                <th>Last Update</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($campaigns as $campaign)
                            <tr @if($campaign->status->class=='live') class="bg-success" @endif>
                                <td><strong><a href="{{ url('/campaigns/' . $campaign->id) }}" class="btn btn-md btn-outline-info btn-block">{{ $campaign->name }}</a></strong></td>
                                <td>{{ $campaign->media_type->name }}</td>
                                <td>
                                       <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>


                                </td>
                                <td>{{ $campaign->budget }}</td>
                                @if ($campaign->creative && count($campaign->creative->media)> 0)

                                <td><strong>@if ($campaign->creative){{ $campaign->creative->reach }} @endif</strong></td>
                                @else
                                <td><strong>Creatives missing</strong></td>
                                @endif
                                <td><strong>@if ($campaign->creative){{  $campaign->creative->clicks}}@endif</strong></td>
                                <td><strong>{{ $campaign->location }}</strong></td>
                                <td><strong>{{ $campaign->radius }}</strong></td>
                                <td><strong>{{ $campaign->gender }}</strong></td>
                                <td><strong>{{ $campaign->age_range }}</strong></td>

                                <td><small>{{ $campaign->start }}</small></td>
                                <td><small>{{ $campaign->updated_at }}</small></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @if($campaign->status->name !=='live')
                                    <a href="{{ url('/campaigns/' . $campaign->id . '/edit') }}" class="btn btn-primary btn-sm">Edit Campaign</a>
                                        @endif
                                    @if($campaign->status->name=='pending review')
                                    <a href="{{ url('/campaigns/' . $campaign->id) }}" class="btn btn-success btn-sm">Review Campaign</a>
                                   @endif
                                    </div>
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

