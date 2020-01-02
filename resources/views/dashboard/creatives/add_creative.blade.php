@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i><strong>{{ __('Create Creative') }} for {{$campaign->name}} </strong>  <h6 class="float-right">{{$campaign->adformat->name}}</h6>
                        </div>
                        <div class="card-body mx-2">
                            <form method="POST" action="{{ route('creatives.store') }}" id="creatives_form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label>Ad Name</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" required autofocus>
                                </div>


                                <div class="form-group row">
                                    <label>Ad Title</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Title') }}" name="title" required>
                                </div>


                                <div class="form-group row">
                                    <label>Ad Descriptive Text</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Descriptive Text') }}" name="description" required>
                                </div>

                                <div class="form-group row">
                                    <label>Ad Link</label>
                                    <input class="form-control" value="http://" type="text" placeholder="{{ __('Ad Link') }}" name="link" required>
                                </div>

                                <div class="form-group row">
                                    <label>Video Advertiser</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Advertiser') }}" name="advertiser" required>
                                </div>

                                <div class="form-group row">
                                    <label>Video Ad Type</label>
                                    <select class="form-control" name="vid_type" required id="vid_type">
                                        <option value="">Select Ad Types</option>
                                        <option value="video_upload">Upload</option>
                                        <option value="video_link">Video Url</option>
                                    </select>
                                </div>

                                <div class="form-group row" id="video_upload">
                                    <label>Ad Video</label>
                                    <input disabled type="file" name="video_path"  id="video_upload_input" class="form-control">
                                </div>

                                <div class="form-group row" id="video_link">
                                    <label>Ad Video Link</label>
                                    <input disabled class="form-control" id="video_link_input" value="" type="text" placeholder="{{ __('Video Link') }}" name="video_link">
                                </div>


                                <div class="form-group row">
                                    <label>Ad Image Size</label>
                                    <select class="form-control" id="ad_image_size" name="ad_image_size" required>
                                        <option value="">Select Image Size</option>
                                        <option value="Mobile (300x250)" data-width="300" data-height="250" id="300_250">Mobile (300x250)</option>
                                        <option value="Mobile (300x250)" data-width="300" data-height="250" id="300_250">Mobile (300x250)</option>
                                        <option value="Tablet (550x480)" data-width="550" data-height="480" id="550_480">Tablet (550x480)</option>
                                        <option value="Mobile (320x480)" data-width="320" data-height="480" id="320_480">Mobile (320x480)</option>
                                        <option value="Full Page Ads (320x480)" data-width="320" data-height="480" id="320_480">Full Page Ads (320x480)</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Ad Type</label>
                                    <select class="form-control" name="type" required>
                                        <option value="">Select Ad Types</option>
                                        <option value="image">Image</option>
                                        <option value="image_button">Image with button</option>
                                        <option value="image_text">Image with text</option>
                                        <option value="image_text_button">Image with text and button</option>
                                    </select>
                                </div>


                                <div class="form-group row">
                                    <label>Ad Devices</label>
                                    <select class="form-control" name="devices" required>
                                        <option value="">Select Device Types</option>
                                        <option value="all">All Devices</option>
                                        <option value="ios">iOS devices</option>
                                        <option value="android">Android Devices</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Ad Image</label>
                                    <input type="file" name="image_path" required id="image_path" class="form-control">
                                </div>


                                <div class="form-group row">
                                    <label>Status</label>
                                    <select class="form-control" name="status_id" readonly>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" @if ($status->id == $selected) selected="selected"
                                                @endif>{{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input class="form-control" value="{{$campaign->id}}" type="hidden" name="campaign_id">
                                <button class="btn btn-block btn-success" type="submit">{{ __('Save creative') }}</button>
                                <a href="{{ url('/campaigns/' . $campaign->id) }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            const parameters = <?=$campaign->adformat->parameters?>;
            console.log(parameters);
            $('#vid_type').on('change', function () {
                $('#video_upload_input').attr('disabled', true);
                $('#video_link_input').attr('disabled', true);
                const vid_type = $(this).children('option:selected').val();
                console.log(vid_type);
                if (vid_type.length > 3)
                {
                    $('#' + vid_type + '_input').attr('disabled', false);
                }

            });
            $('#ad_image_size').on('change', function () {
                const imageSize = $(this).children('option:selected').data();


            });
            $($('#creatives_form').prop('elements')).each(function () {
                if (!Object.keys(parameters).includes($(this).attr('name')))
                {
                    const default_values = ['status_id', 'title', 'campaign_id', 'link', '_token'];
                    if (!default_values.includes($(this).attr('name')))
                    {
                        $(this).closest('.form-group').remove();
                    }

                }
            });
        });
    </script>

@endsection
