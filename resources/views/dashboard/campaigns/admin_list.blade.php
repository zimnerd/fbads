@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('Campaigns') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('campaigns.create') }}" class="btn btn-info m-2 float-right">{{ __('Add
                                Campaign') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-sm table-bordered table-striped w-100">
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
                                <th>Action</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($campaigns as $campaign)
                            <tr>
                                <td><strong><a href="{{ url('/campaigns/' . $campaign->id) }}"
                                               class="btn btn-md btn-outline-info btn-block">{{ $campaign->name
                                            }}</a></strong></td>
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
                                <td><strong>@if ($campaign->creative){{ $campaign->creative->clicks}}@endif</strong>
                                </td>
                                <td><strong>{{ $campaign->location }}</strong></td>
                                <td><strong>{{ $campaign->radius }}</strong></td>
                                <td><strong>{{ $campaign->gender }}</strong></td>
                                <td><strong>{{ $campaign->age_range }}</strong></td>
                                <td>
                                    <small>{{ $campaign->start->format('d-m-Y') }}</small>
                                </td>
                                <td>
                                    @if ($campaign->trashed())
                                    Trashed
                                    @else
                                    <div class="row no-gutters">
                                        <div class="col-md-3 no-gutters">
                                            <form
                                                action="{{ route('campaigns.edit_status', [$campaign->id,'stopped']) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn-sm btn-block btn-danger" title="Stop">
                                                    Stop
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-3 no-gutters">
                                            <form
                                                action="{{ route('campaigns.edit_status', [$campaign->id,'ongoing']) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn-sm  btn-block btn-success" title="Start">
                                                    Accept
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-3 no-gutters">
                                            <form
                                                action="{{ route('campaigns.edit_status', [$campaign->id,'paused']) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn-sm  btn-block btn-info" title="Pause">
                                                    Pause
                                                </button>
                                            </form>
                                        </div>
                                        @if ($campaign->creative)
                                        <div class="col-md-3 no-gutters">
                                            <form
                                                action="{{ route('campaigns.edit_status', [$campaign->id,'rejected']) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button type="button" id="showReason_{{$campaign->creative->id}}"
                                                        class="btn-sm  btn-block btn-warning" title="Reject">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>

                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-outline-dark btn-sm"
                                           href="{{ url('/campaigns/' . $campaign->id.'/capture') }}">Capture Data</a>
                                        @if($campaign->status->name =="pending")
                                        <a href="{{ url('/campaigns/' . $campaign->id . '/edit') }}"
                                           class="btn btn-outline-primary btn-sm">Edit Campaign</a>
                                        @if ($campaign->creative)<a
                                            href="{{ url('/creatives/' . $campaign->creative->id . '/edit/submit_for_review') }}"
                                            class="btn btn-outline-primary btn-sm">Send for Review</a>
                                        @endif
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('campaigns.destroy', $campaign->id ) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">You are about to reject the Ad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action=""
                          id="rejection" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Reject Reason:</label>
                            <textarea class="form-control" id="rejection_reason"
                                      placeholder="Enter the reason why you are rejecting the Advert"
                                      name="rejection_reason" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="submitForm();">Reject Ad</button>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection


@section('javascript')
<script>
    function submitForm(){
        $('#rejection').submit();
    }

    $(document).ready(function(){
        console.log('READY');
        $('[id^="showReason"]').on('click', function(){
            var id = $(this).attr('id');
            var creative_id = id.split('_')[1];
            $('#exampleModal').modal('show');
            $('#rejection').attr('action', '/creatives/' + creative_id);
        });

    });
</script>

@endsection

