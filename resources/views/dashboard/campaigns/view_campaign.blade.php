<style>
    .editable
    {
        border-radius: 10px;
        background-color: rgba(27, 158, 62, 0.22);
    }
</style>
@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                @if($capture)
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                                <h4>Capture and Edit campaign data<span><button class="btn btn-light m-2 float-right">{{ __('Click the green box to edit') }}</button></span>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div id="message"></div>

                                <table class="table table-responsive-sm table-sm table-striped">
                                    <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Creative Title</th>
                                        <th>Status</th>
                                        <th>Landing page</th>
                                        <th>Reach</th>
                                        <th>Clicks</th>
                                        <th>Frequency</th>
                                        @if ($campaign->media_type->name =="video")
                                            <th>Video Views</th>
                                        @endif
                                        <th>Engagement</th>
                                        <th>CTR</th>
                                        <th>Setup</th>
                                        <th>Ready</th>
                                        <th>Active</th>
                                        <th>Finished</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($campaign->creative)
                                        <tr>
                                            <td @if ($isadmin) contenteditable class="column_name editable" data-column_name="title"
                                                data-id="{{$campaign->creative->id}}" @endif width="8%">{{$campaign->creative->title}}
                                            </td>
                                            <td width="5%"><span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>
                                            </td>
                                            <td @if ($isadmin)
                                                contenteditable class="column_name editable" data-column_name="link"
                                                data-id="{{$campaign->creative->id}}" @endif  width="8%">{{$campaign->creative->link}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable" data-column_name="reach"
                                                data-id="{{$campaign->creative->id}}" @endif>{{$campaign->creative->reach}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable"
                                                data-column_name="clicks" data-id="{{$campaign->creative->id}}" @endif>
                                                {{$campaign->creative->clicks}}
                                            </td>

                                            <td @if ($isadmin) contenteditable class="column_name editable"
                                                data-column_name="frequency" data-id="{{$campaign->creative->id}}" @endif>
                                                {{$campaign->creative->frequency}}
                                            </td>
                                            @if ($campaign->media_type->name =="video")
                                                <td @if ($isadmin) contenteditable class="column_name editable"
                                                    data-column_name="video_views" data-id="{{$campaign->creative->id}}" @endif>
                                                    {{$campaign->creative->video_views}}
                                                </td>
                                            @endif
                                            <td @if ($isadmin) contenteditable class="column_name editable"
                                                data-column_name="engagement_rate" data-id="{{$campaign->creative->id}}" @endif>
                                                {{$campaign->creative->engagement_rate}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable"
                                                data-column_name="ctr" data-id="{{$campaign->creative->id}}" @endif>
                                                {{$campaign->creative->ctr}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable" data-column_name="setup"
                                                data-id="{{$campaign->creative->id}}" @endif>{{$campaign->creative->setup}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable" data-column_name="ready"
                                                data-id="{{$campaign->creative->id}}" @endif>{{$campaign->creative->ready}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable"
                                                data-column_name="active" data-id="{{$campaign->creative->id}}" @endif>
                                                {{$campaign->creative->active}}
                                            </td>
                                            <td @if ($isadmin) contenteditable class="column_name editable"
                                                data-column_name="finished" data-id="{{$campaign->creative->id}}" @endif>
                                                {{$campaign->creative->finished}}
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </div>
                @endif
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
                            <li class="list-group-item"><strong>Interest: </strong> {{$campaign->interest->description}}</li>
                            <li class="list-group-item"><strong>Other Interest: </strong> {{$campaign->other_interests}}</li>
                            <li class="list-group-item"><strong>Ad Format: </strong> {{$campaign->media_type->name}}</li>
                            <li class="list-group-item"><strong>Facebook Page: </strong>
                                {{$campaign->creative->facebook_page}}
                            </li>
                            <li class="list-group-item"><strong>Facebook Email: </strong>
                                {{$campaign->creative->facebook_email}}
                            </li>
                            <li class="list-group-item"><strong>Landing Page: </strong> {{$campaign->creative->link}}</li>
                            <li class="list-group-item"><strong>Start date : </strong> {{$campaign->start}}</li>
                            </li>
                        </ul>

                    </div>

                </div>
                <div class="col-sm-9 col-md-5 col-lg-5 col-xl-5">
                    @if($campaign->status->name == "ready" || $campaign->status->name == "completed" || $campaign->status->name == "pending review")
                        <div class="card">
                            <div class="card-body text-black-50">
                                <label style="width: 100%">Current Ad <small>(Click image to enlarge)</small> <span class="float-right"><button type="button" class="btn btn-default" onclick="hideSection('current_ad')">Hide / Unhide section</button></span></label>
                                <div class="row" id="current_ad">
                                    <div class="col-md-6 text-center">
                                        @foreach($campaign->creative->media as $adfile)
                                            @if($adfile->screenshot_path !== NULL)

                                                <a href="#" title="{{$campaign->creative->description}}" class="thumb">
                                                    <img src="{{$adfile->link}}" class="img-responsive img-rounded" width="100%" data-toggle="modal" data-target=".modal-profile-lg">
                                                </a>
                                                <small>click to zoom</small>
                                                {{--                                <img class="card-img-top" src="{{$adfile->link}}" alt="{{$adfile->name}}">--}}

                                            @endif
                                        @endforeach
                                    </div>
                                    @if($campaign->status->name == "pending review")
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('campaigns.edit_status', [$campaign->id,'ready']) }}"
                                                          method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn btn-lg btn-block btn-success" title="Start"
                                                                onclick="comments('hide')">
                                                            Approve and publish
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-block btn-lg btn-danger" title="Decline with comments"
                                                            onclick="comments('show')">Decline with comments
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="comments">

                                                <form method="POST" action="/creatives/{{ $campaign->creative->id}}"
                                                      id="creatives_form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group row">
                                                        <label>Add comments</label>
                                                        <textarea class="form-control" type="text"
                                                                  placeholder="{{ __('Add comments') }}"
                                                                  value="{{$campaign->creative->comments}}" name="comments"
                                                                  required>{{$campaign->creative->comments}}</textarea>
                                                    </div>
                                                    <input class="form-control" value="{{$campaign->id}}" type="hidden"
                                                           name="campaign_id">
                                                    <div class="form-group row">

                                                        <div class="col-md-12">
                                                            <button class="btn btn-lg btn-success float-right" type="submit">{{
                                                    __('Decline and submit comment') }}
                                                            </button>
                                                        </div>


                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    @if($campaign->status->name == "ready" || $campaign->status->name == "live"  || $campaign->status->name == "completed")
                                        <div class="col-md-6">
                                            <h3 class="text-success">Campaign approved</h3>
                                            <hr>
                                            <h5 class="text-info">Current status: {{$campaign->status->name }}</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card bg-info text-white-50">
                        <div class="card-body">
                            <h4 class="card-title">Campaign Details</h4>
                            <p class="card-text">Your lifetime stats</p>
                            <a class="btn btn-success btn-lg" id="downloadReport"
                               href="{{action('CampaignController@downloadPDF', $campaign->id)}}">Download Pdf Report</a>
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
                                    <h3>{{$campaign->creative->reach}}</h3>
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
                                    <h3>{{$campaign->creative->clicks}}</h3>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="card-title">Engagement</h5>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>How many interactions your ad received out of people who saw it</p>
                                </div>
                                <div class="col-md-4">
                                    <h3>{{$campaign->creative->engagement_rate}}</h3>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="card-title">CTR</h5>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Click through rate</p>
                                </div>
                                <div class="col-md-4">
                                    <h3>{{$campaign->creative->ctr}}</h3>
                                </div>
                            </div>

                        </div>
                    </div>
                    @if ($campaign->media_type->name =="video")


                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h5 class="card-title">Frequency</h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>The number of times your ad has been seen on average by each user</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>{{$campaign->creative->frequency}}</h3>
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
                                        <h3>{{$campaign->creative->video_views}}</h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif


                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="card  text-white">
                        <div class="card-body">
                            <h2 class="card-title text-dark"><strong>Campaign process</strong></h2>
                            <div class="row border-info rounded my-3">
                                <div class="col-md-6 text-dark">Campaign Status</div>
                                <div class="col-md-6">
                                <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>

                                </div>
                                @if($campaign->status->name == "rejected")
                                    <hr>
                                    <div class="col-md-12">
                                        <h6 class="text-white bg-danger">Rejection reason:</h6>
                                        <p class="text-danger">{{$campaign->creative->rejection_reason}}</p>
                                    </div>
                                @endif
                                @if($campaign->status->name == "pending" && $campaign->creative->comments != NULL)
                                    <hr>
                                    <div class="col-md-12">
                                        <h6 class="text-white bg-info">Ads review comments:</h6>
                                        <p class="text-dark">{{$campaign->creative->comments}}</p>
                                    </div>
                                @endif

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
                            @if ($campaign->creative->finished == 1 )
                                <label class="text-black-50">Completed</label>
                                <div class="progress">
                                    <div class="progress-bar progress-bar bg-danger" role="progressbar" @if ($campaign->creative->finished == 1 ) style="width: 100%"
                                         aria-valuenow="100" @else style="width: 0%" aria-valuenow="0" @endif
                                         aria-valuemin="0" aria-valuemax="100">@if ($campaign->creative->finished == 1
                                )Completed @else Not complete @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h4 class="card-title">Ad Library</h4>
                        </div>
                    </div>

                    @if($screenshot)
                        @foreach($campaign->creative->media as $adfile)
                            @if($adfile->screenshot_path !== NULL)
                                <div class="card">
                                    <div class="card-body">
                                        <label class="text-black-50">Current Ad screenshot </label>
                                        <a href="#" title="{{$campaign->creative->description}}" class="thumb">
                                            <img src="{{$adfile->link}}" class="img-responsive img-rounded" width="100%" data-toggle="modal" data-target=".modal-profile-lg">
                                        </a>
                                        <small>click to zoom</small>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        @foreach($campaign->creative->media as $adfile)
                            @if($adfile->image_path !== NULL && $adfile->screenshot_path == NULL)
                                <div class="card">
                                    <div class="card-body text-black-50">
                                        <label>Image : {{$campaign->creative->title}}</label>
                                        <img class="card-img-top" src="{{$adfile->link}}" alt="{{$adfile->name}}">
                                        <a class="card-text text-info" href="{{$campaign->creative->link}}" target="_blank">Landing page link</a>
                                    </div>
                                </div>
                            @elseif($adfile->video_path !== NULL && $adfile->screenshot_path == NULL)
                                <div class="card">
                                    <div class="card-body">
                                        <label class="text-black-50">Video : {{$campaign->creative->title}}</label>
                                        <video width="100%" controls id="carouselVideo">
                                            <source src="{{$adfile->link}}" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                        </video>
                                        <a class="card-text" href="{{$campaign->creative->link}}" target="_blank">Landing page link</a>
                                    </div>
                                </div>

                            @endif
                        @endforeach
                    @endif

                </div>
            </div>

        </div>

        {{--    modal --}}
        <div class="modal fade modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 80% !important; max-width: 1000px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">X</button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        {{--    modal end--}}
    </div>

@endsection


@section('javascript')

    <script>function hideSection(section)
        {
            $('#' + section + '').toggle();
        }

        $('#comments').hide();

        function comments(action)
        {
            if (action == 'show')
            {
                $('#comments').show();
            }
            else
            {
                $('#comments').hide();
            }

        }

        $(document).ready(function () {

            $('a.thumb').click(function (event) {
                event.preventDefault();
                var content = $('.modal-body');
                content.empty();
                var title = '<strong>Ad description:</strong> ' + $(this).attr('title');
                var title = '<strong>Ad description:</strong> ' + $(this).attr('title');
                $('.modal-title').html(title);
                content.html($(this).html());
                $('.modal-profile').modal({show: true});
            });

            const _token = $('input[name="_token"]').val();
            $('.column_name').on('keypress', function (e) {
                if (e.which === 13)
                {
                    $(this).trigger('blur');
                }
            });
            $(document).on('blur', '.column_name', function () {
                const column_name = $(this).data('column_name');
                const column_value = $(this).text();
                const id = $(this).data('id');

                if (column_value !== '')
                {
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
                else
                {
                    $('#message').html('<div class=\'alert alert-danger\'>Enter some value</div>').delay(8000).slideUp(200, function () {
                        $(this).alert('close');
                        location.reload();
                    });
                }
            });

            $(document).on('blur', '.column_name', function () {
                const column_name = $(this).data('column_name');
                const column_value = $(this).text();
                const id = $(this).data('id');
                if (['setup', 'ready', 'active', 'finished'].includes(column_name))
                {
                    if (['0', '1'].includes(column_value))
                    {

                    }
                    else
                    {
                        $('#message').html('<div class=\'alert alert-danger\'>The input value can only be 1 or 0 for ' + column_name + '.</div>').delay(8000).slideUp(200, function () {
                            $(this).alert('close');
                            location.reload();
                        });
                    }
                }
                if (column_value !== '')
                {
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
                else
                {
                    $('#message').html('<div class=\'alert alert-danger\'>Enter some value</div>').delay(8000).slideUp(200, function () {
                        $(this).alert('close');
                        location.reload();
                    });
                }
            });

        });
    </script>

@endsection

