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
                                    <th>Last Update</th>
                                    <th>Action</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaigns as $campaign)
                                    <tr>
                                        <td><strong><a href="{{ url('/campaigns/' . $campaign->id) }}" class="">{{ $campaign->name }}</a></strong></td>
                                        <td>{{ $campaign->media_type->name }}</td>
                                        <td>
                                       <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>


                                        </td>
                                        <td>{{ $campaign->budget }}</td>
                                        @if ($campaign->creative && count($campaign->creative->media)> 0)

                                            <td><strong>{{ $campaign->creative->reach }}</strong></td>
                                        @else
                                            <td><strong>Creatives missing</strong></td>
                                        @endif
                                        <td><strong>@if ($campaign->creative){{  $campaign->creative->clicks}}@endif</strong></td>
                                        <td><strong>{{ $campaign->location }}</strong></td>
                                        <td><strong>{{ $campaign->radius }}</strong></td>
                                        <td><strong>{{ $campaign->gender }}</strong></td>
                                        <td><strong>{{ $campaign->age_range }}</strong></td>

                                        <td><small>{{ $campaign->updated_at }}</small></td>
                                        <td>
                                            @if ($campaign->trashed())
                                                Trashed
                                            @else
                                                <div class="row no-gutters">
                                                    <div class="col-md-3 no-gutters">
                                                        <form action="{{ route('campaigns.edit_status', [$campaign->id,'stopped']) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button class="btn-sm btn-block btn-danger" title="Stop">
                                                          Stop
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-3 no-gutters">
                                                        <form action="{{ route('campaigns.edit_status', [$campaign->id,'ongoing']) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button class="btn-sm  btn-block btn-success" title="Start">
                                                            Accept
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-3 no-gutters">
                                                        <form action="{{ route('campaigns.edit_status', [$campaign->id,'paused']) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button class="btn-sm  btn-block btn-info" title="Pause">
                                                                Pause
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-3 no-gutters">
                                                        <form action="{{ route('campaigns.edit_status', [$campaign->id,'rejected']) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button class="btn-sm  btn-block btn-warning" title="Reject">
                                                                Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                            @endif
                                        </td>
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

