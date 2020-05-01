<!--suppress ALL -->

@extends('dashboard.base')

@section('content')
    <!--suppress ALL -->
<div class="container-fluid">

        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card bg-info  text-white">
                        <div class="card-body">
                            <h2 class="card-title"><strong>Campaign title: </strong>  {{$campaign->name}}</h2>
                            <p class="card-text"><strong>Campaign Type: </strong>  {{$campaign->media_type->name}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Creator: </strong>  {{$campaign->user->name}} </li>
                            <li class="list-group-item"><strong>Company: </strong>  {{$campaign->user->organisation}} </li>
                            <li class="list-group-item"><strong>Budget: </strong>  {{$campaign->budget}} </li>
                            <li class="list-group-item"><strong>Goal type: </strong>  {{$campaign->goal->name}} </li>
                            <li class="list-group-item"><strong>Mode : </strong>  {{$campaign->ad_period}} Months </li>
                            <li class="list-group-item"><strong>Locations: </strong>  {{$campaign->location}} </li>
                            <li class="list-group-item"><strong>Radius: </strong>  {{$campaign->radius}} </li>
                            <li class="list-group-item"><strong>Gender: </strong>  {{$campaign->gender}} </li>
                            <li class="list-group-item"><strong>Age: </strong>  {{$campaign->age_range}} </li>
                            <li class="list-group-item"><strong>Interest: </strong>  {{$campaign->interest->description}} </li>
                            <li class="list-group-item"><strong>Ad Format: </strong>  {{$campaign->media_type->name}} </li>
                            <li class="list-group-item"><strong>Facebook Page: </strong>  {{$campaign->facebook_page}} </li>
                            <li class="list-group-item"><strong>Landing Page: </strong>  {{$campaign->link}} </li>
                            <li class="list-group-item"><strong>Start date : </strong>  {{$campaign->start}} </li>
                        </ul>
                    </div>

                </div>
                <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i><strong>{{ __('Ad Settings') }} </strong>  <h6 class="float-right"><strong>Type: </strong>  {{$campaign->media_type->name}} : <strong>Allowed files :</strong> {{$campaign->media_type->allowed_types}}</h6>
                        </div>
                        <div class="card-body mx-2">
                            <label>Ad Files</label>
                            <form method="post" action="{{route('creatives.storeMedia')}}" enctype="multipart/form-data"
                                  class="dropzone mb-3   {{ $errors->has('ad_media') ? 'border-danger rounded' : ''}}" id="dropzone">
                                @csrf
                                {!! $errors->first('ad_media', '<p class="text-danger">:message</p>') !!}
                            </form>

                            <form method="POST" action="{{ route('creatives.store') }}" id="creatives_form" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row {{ $errors->has('title') ? 'border-danger rounded' : ''}}">
                                    <label>Ad Title</label>
                                    <input class="form-control" value="{{ old('title') }}"  type="text" placeholder="{{ __('Title') }}" name="title" required>
                                    {!! $errors->first('title', '<p class="text-danger">:message</p>') !!}
                                </div>


                                <div class="form-group row {{ $errors->has('description') ? 'border-danger rounded' : ''}}">
                                    <label>Ad Descriptive Text</label>
                                    <textarea class="form-control" type="text"  placeholder="{{ __('Descriptive Text') }}" name="description" required>{{ old('description') }}</textarea>
                                    {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
                                </div>

                                <div class="form-group row {{ $errors->has('link') ? 'border-danger rounded' : ''}}">
                                    <label>Landing page</label>
                                    <input class="form-control"  value="{{ old('link') }}"  type="url" placeholder="{{ __('Ad Link') }}" name="link" required>
                                    {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <div class="form-group row {{ $errors->has('facebook_page') ? 'border-danger rounded' : ''}}">
                                    <label>Facebook page</label>
                                    <input class="form-control" value="{{ old('facebook_page') }}"  type="url" placeholder="{{ __('Facebook page') }}" name="facebook_page" required>
                                    {!! $errors->first('facebook_page', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <div class="form-group row {{ $errors->has('facebook_email') ? 'border-danger rounded' : ''}}">
                                    <label>Facebook email</label>
                                    <input class="form-control" value="{{ old('facebook_email') }}"  type="email" placeholder="{{ __('Facebook email') }}" name="facebook_email" required>
                                    {!! $errors->first('facebook_email', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <div class="form-group row {{ $errors->has('notes') ? 'border-danger rounded' : ''}}">
                                    <label>Ad Extra Information</label>
                                    <textarea class="form-control" type="text"  placeholder="{{ __('Extra Inforamtion') }}" name="notes" required>{{ old('notes') }}</textarea>
                                    {!! $errors->first('notes', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <input class="form-control" value="{{$campaign->id}}" type="hidden" name="campaign_id">
                                <div class="form-group row">
                                    <div class="col-md-6">           <a href="{{ url('/campaigns/' . $campaign->id) }}" class="btn btn-lg btn-info float-left">{{ __('Return') }}</a></div>
                                    <div class="col-md-6"> <button class="btn btn-lg btn-success float-right" type="submit">{{ __('Save creative') }}</button></div>


                                </div>
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
        const parameters = <?=$campaign->media_type->metadata?>;
        const min = <?=$campaign->media_type->min?>;
        const max = <?=$campaign->media_type->max?>;
        const allowed = "<?=$campaign->media_type->allowed_types?>";
        console.log(parameters);

//        Dropzone.autoDiscover = false;
var uploadedDocumentMap = {}
        Dropzone.options.dropzone = {
            url: '{{ route('creatives.storeMedia') }}',
            maxFiles: max,
            maxFilesize: 30, // MB
            addRemoveLinks: true,
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        addRemoveLinks: true,
            acceptedFiles: allowed,
        success: function (file, response) {

            console.log("RES: ",response);
            $('#creatives_form').append('<input type="hidden" name="ad_media[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        error: function(file, response)
        {
            console.log(file)
            console.log("RESPONSE:",response)
            alert(response)
            file.previewElement.remove();

        },
        removedfile: function (file) {
            console.log("FILE DEL: ",file);
            var request_data = {file_data:file.xhr.response}
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('#creatives_form').find('input[name="ad_media[]"][value="' + name + '"]').remove();
            var name = file.upload.filename;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: '{{ url("creatives/delete_media") }}',
                data: request_data,
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
        },
        init: function () {
            this.on('addedfile', function(file) {
                if (this.files.length > max) {
                    this.removeFile(this.files[0]);
                }
            });
            console.log("INIT")
            @if(isset($creative) && $creative->ad_media)
                var files =
                    {!! json_encode($creative->ad_media) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="ad_media[]" value="' + file.file_name + '">')
                }
            @endif
            }
        }

        $(document).ready(function () {


        });
    </script>


@endsection
