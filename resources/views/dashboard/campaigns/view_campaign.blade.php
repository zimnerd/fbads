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
                            <i class="fa fa-align-justify"></i> <h4>Creatives<span><a href="{{ route('creatives.create',['id'=>$campaign->id] ) }}" class="btn btn-primary m-2 float-right">{{ __('Add Creative') }}</a></span></h4></div>
                        <div class="card-body">
                            <div id="message"></div>

                            <table class="table table-responsive-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Creative Ad</th>
                                    <th>Creative ID</th>
                                    <th>Status</th>
                                    <th>Creative URL</th>
                                    <th>Impressions</th>
                                    <th>Clicks</th>
                                    <th>CTR Avg.</th>
                                    <th>Bid</th>
                                    <th>Spent</th>
                                    <th>Conv.</th>
                                    <th>Conv. Rate</th>
                                    <th>CPA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaign->creative as $creative)
                                    <tr>
                                        <td>{{$creative->name}}</td>
                                        <td>{{$creative->id}}</td>
                                        <td>
                                  <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>
                                        </td>
                                        <td contenteditable class="column_name" data-column_name="link" data-id="{{$creative->id}}">{{$creative->link}}</td>
                                        <td contenteditable class="column_name" data-column_name="impressions" data-id="{{$creative->id}}">{{$creative->impressions}}</td>
                                        <td contenteditable class="column_name" data-column_name="clicks" data-id="{{$creative->id}}">{{$creative->clicks}}</td>
                                        @if ($creative->impressions > 0 && $creative->clicks >= 0)
                                            <td><?= round(($creative->clicks / $creative->impressions) * 100, 2) ?> %</td>
                                        @else

                                            <td>N/A</td>
                                        @endif
                                        <td>{{$campaign->current_bid}}</td>
                                        <td contenteditable class="column_name" data-column_name="spend" data-id="{{$creative->id}}">{{$creative->spend}}</td>
                                        <td contenteditable class="column_name" data-column_name="conversion" data-id="{{$creative->id}}">{{$creative->conversion}}</td>
                                        @if ($creative->conversion >= 0 && $creative->clicks > 0)
                                            <td><?= round(($creative->conversion / $creative->clicks) * 100, 2) ?> %</td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        @if ($creative->spend >= 0 && $creative->clicks > 0)
                                            <td><?= round(($creative->spend / $creative->clicks), 2)?></td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ csrf_field() }}
                        </div>
                    </div>
                </div>


            </div>
            <a href="{{ route('campaigns.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>

        </div>
    </div>

@endsection


@section('javascript')

    <script>

        $(document).ready(function () {
            const _token = $('input[name="_token"]').val();
            $(".column_name").on('keypress',function(e) {
                if(e.which === 13) {
                    $(this).trigger("blur");
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
                            $('#message').html(data).delay(3000).slideUp(200, function() {
                                $(this).alert('close');
                                location.reload();
                            });
                        }
                    });
                }
                else
                {
                    $('#message').html("<div class='alert alert-danger'>Enter some value</div>").delay(8000).slideUp(200, function() {
                        $(this).alert('close');
                        location.reload();
                    });
                }
            });

        });
    </script>

@endsection

