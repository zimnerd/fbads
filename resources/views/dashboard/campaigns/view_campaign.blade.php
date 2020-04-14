@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card bg-info  text-white">
                    <div class="card-body">
                        <h2 class="card-title"><strong>Campaign title: </strong> {{$campaign->name}}</h2>
                        <p class="card-text"><strong>Campaign Type: </strong> {{$campaign->media_type->name}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Creator: </strong> {{$campaign->user->name}}</li>
                        <li class="list-group-item"><strong>Company: </strong> {{$campaign->user->organisation}}</li>
                        <li class="list-group-item"><strong>Budget: </strong> {{$campaign->budget}}</li>
                        <li class="list-group-item"><strong>Goal type: </strong> {{$campaign->goal->name}}</li>
                        <li class="list-group-item"><strong>Mode : </strong> {{$campaign->ad_period}} Months</li>
                        <li class="list-group-item"><strong>Locations: </strong> {{$campaign->location}}</li>
                        <li class="list-group-item"><strong>Radius: </strong> {{$campaign->radius}}</li>
                        <li class="list-group-item"><strong>Gender: </strong> {{$campaign->gender}}</li>
                        <li class="list-group-item"><strong>Age: </strong> {{$campaign->age_range}}</li>
                        <li class="list-group-item"><strong>Interest: </strong> {{$campaign->interest->description}}
                        </li>
                        <li class="list-group-item"><strong>Ad Format: </strong> {{$campaign->media_type->name}}</li>
                        <li class="list-group-item"><strong>Facebook Page: </strong>
                            {{$campaign->creative->facebook_page}}
                        </li>
                        <li class="list-group-item"><strong>Facebook Email: </strong>
                            {{$campaign->creative->facebook_email}}
                        </li>
                        <li class="list-group-item"><strong>Landing Page: </strong> {{$campaign->creative->link}}</li>
                        <li class="list-group-item"><strong>Start date : </strong> {{$campaign->start}}</li>
                        <li class="list-group-item"><strong>Businesss category: </strong> {{$campaign->category->name}}
                        </li>
                    </ul>

                </div>

            </div>
            <div class="col-sm-9 col-md-5 col-lg-5 col-xl-5">
                <div class="card bg-info text-white-50">
                    <div class="card-body">
                        <h4 class="card-title">Campaign Details</h4>
                        <p class="card-text">Your lifetime stats</p>
                        <a class="btn btn-success btn-lg" id="downloadReport" href="{{action('CampaignController@downloadPDF', $campaign->id)}}">Download Pdf Report</a>
                    </div>
                </div>

                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">People reached</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p>The number of users who have seen your ads</p>
                            </div>
                            <div class="col-md-4">
                                <h2>{{$campaign->creative->reach}}</h2>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Frequency</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p>The number of times your ad has been seen on average by each user</p>
                            </div>
                            <div class="col-md-4">
                                <h2>{{$campaign->creative->frequency}}</h2>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total clicks</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p>The total number of times user clicked anywhere on your ad</p>
                            </div>
                            <div class="col-md-4">
                                <h2>{{$campaign->creative->clicks}}</h2>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Engagement rate</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p>How many interactions your ad received out of people who saw it</p>
                            </div>
                            <div class="col-md-4">
                                <h2>{{$campaign->creative->engagement_rate}}</h2>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Video views</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <p>How many times the video featured in your ad was viewed</p>
                            </div>
                            <div class="col-md-4">
                                <h2>{{$campaign->creative->video_views}}</h2>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <div class="card  text-white">
                    <div class="card-body">
                        <h2 class="card-title text-dark"><strong>Campaign process</h2>
                        <div class="row border-info rounded my-3">
                            <div class="col-md-6 text-dark">Campaign Status</div>
                            <div class="col-md-6">
                                <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>

                            </div>

                        </div>
                        <label class="text-black-50">Ad Setup</label>
                        <div class="progress">
                            <div class="progress-bar progress-bar" role="progressbar" @if ($campaign->creative->setup ==
                                1) style="width: 100%" aria-valuenow="100" @else style="width: 0%" aria-valuenow="0"
                                @endif
                                aria-valuemin="0" aria-valuemax="100">@if ($campaign->creative->setup == 1)Completed
                                @else Not complete @endif
                            </div>
                        </div>

                        <label class="text-black-50">Ready</label>
                        <div class="progress">
                            <div class="progress-bar progress-bar bg-success" role="progressbar" @if ($campaign->
                                creative->ready == 1) style="width: 100%" aria-valuenow="100" @else style="width: 0%"
                                aria-valuenow="0" @endif
                                aria-valuemin="0" aria-valuemax="100">@if ($campaign->creative->ready == 1)Completed
                                @else Not complete @endif
                            </div>
                        </div>

                        <label class="text-black-50">Active</label>
                        <div class="progress">
                            <div class="progress-bar progress-bar-stripped bg-info" role="progressbar" @if ($campaign->
                                creative->active == 1) style="width: 100%" aria-valuenow="100" @else style="width: 0%"
                                aria-valuenow="0" @endif
                                aria-valuemin="0" aria-valuemax="100">@if ($campaign->creative->active == 1)Completed
                                @else Not complete @endif
                            </div>
                        </div>

                        <label class="text-black-50">Completed</label>
                        <div class="progress">
                            <div class="progress-bar progress-bar bg-danger" role="progressbar" @if ($campaign->
                                creative->completed == 1 || $campaign->end < Carbon\Carbon::now()) style="width: 100%"
                                aria-valuenow="100" @else style="width: 0%" aria-valuenow="0" @endif
                                aria-valuemin="0" aria-valuemax="100">@if ($campaign->creative->completed == 1 ||
                                $campaign->end < Carbon\Carbon::now())Completed @else Not complete @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h4 class="card-title">Ad Library ({{count($campaign->creative->media)}})</h4>
                    </div>
                </div>

                @foreach($campaign->creative->media as $adfile)
                @if($adfile->image_path !== null)
                <div class="card">
                    <div class="card-body text-black-50">
                        <label>Image : {{$campaign->creative->title}}</label>
                        <img class="card-img-top" src="{{$adfile->link}}" alt="{{$adfile->name}}">
                        <p class="card-text"><strong>Landing Page</strong></p>
                        <a class="card-text text-info" href="{{$campaign->creative->link}}" target="_blank">{{$campaign->creative->link}}</a>
                    </div>
                </div>
                @elseif($adfile->video_path !== null)
                <div class="card">
                    <div class="card-body">
                        <label class="text-black-50">Video : {{$campaign->creative->title}}</label>
                        <video width="100%" controls id="carouselVideo">
                            <source src="{{$adfile->link}}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        <a class="card-text" href="{{$campaign->creative->link}}" target="_blank">{{$campaign->creative->link}}</a>
                    </div>
                </div>

                @endif
                @endforeach


            </div>
        </div>

        <div class="row">


        </div>
        <a href="{{ route('campaigns.index') }}" class="btn btn-block btn-info">{{ __('Return') }}</a>

    </div>
</div>

@endsection


@section('javascript')

<script>

    $(document).ready(function () {
        const _token = $('input[name="_token"]').val();
        $('.column_name').on('keypress', function (e) {
            if (e.which === 13) {
                $(this).trigger('blur');
            }
        });
        $(document).on('blur', '.column_name', function () {
            const column_name = $(this).data('column_name');
            const column_value = $(this).text();
            const id = $(this).data('id');

            if (column_value !== '') {
                $.ajax({
                    url: "{{ route('creatives.live_update') }}",
                    method: 'POST',
                    data: {column_name: column_name, column_value: column_value, id: id, _token: _token},
                    success: function (data) {
                        console.log(data);
                        $('#message').html(data).delay(3000).slideUp(200, function () {
                            $(this).alert('close');
                            location.reload();
                        });
                    }
                });
            }
            else {
                $('#message').html('<div class=\'alert alert-danger\'>Enter some value</div>').delay(8000).slideUp(200, function () {
                    $(this).alert('close');
                    location.reload();
                });
            }
        });

    });
</script>

@endsection

