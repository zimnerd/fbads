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
                        {{$action}}
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
                        <li class="list-group-item"><strong>Businesss category: </strong>  {{$campaign->category->name}} </li>
                    </ul>
                </div>

            </div>
            @if($action =='submit_for_review')
            <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><strong>{{ __('Ad Settings') }} </strong>  <h6 class="float-right"><strong>Type: </strong>  {{$campaign->media_type->name}} : <strong>Allowed files :</strong> .jpg,.pgn,.gif</h6>
                    </div>
                    <div class="card-body mx-2">
                        <label>Attach Screenshot</label>
                        <form method="post" action="{{route('creatives.storeMedia')}}" enctype="multipart/form-data"
                              class="dropzone mb-3" id="dropzone1">
                            @csrf
                        </form>

                        <form method="POST" action="/creatives/{{ $creative->id }}" id="creatives_ss_form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input class="form-control" value="{{$campaign->id}}" type="hidden" name="campaign_id">
                            <input class="form-control" value="{{$action}}" type="hidden" name="action">
                            <div class="form-group row">
                                <div class="col-md-6">           <a href="{{ url('/campaigns/' . $campaign->id) }}" class="btn btn-lg btn-info float-left">{{ __('Return') }}</a></div>
                                <div class="col-md-6"> <button class="btn btn-lg btn-success float-right" type="submit">{{ __('Submit for review') }}</button></div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><strong>{{ __('Ad Settings') }} </strong>  <h6 class="float-right"><strong>Type: </strong>  {{$campaign->media_type->name}} : <strong>Allowed files :</strong> {{$campaign->media_type->allowed_types}}</h6>
                    </div>
                    <div class="card-body mx-2">
                        <label>Ad Files</label>
                        <form method="post" action="{{route('creatives.storeMedia')}}" enctype="multipart/form-data"
                              class="dropzone mb-3" id="dropzone">
                            @csrf
                        </form>

                        <form method="POST" action="/creatives/{{ $creative->id }}" id="creatives_form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                            <div class="form-group row">
                                <label>Ad Title</label>
                                <input class="form-control" type="text" placeholder="{{ __('Title') }}" value="{{$creative->title}}" name="title" required>
                            </div>


                            <div class="form-group row">
                                <label>Ad Descriptive Text</label>
                                <textarea class="form-control" type="text" placeholder="{{ __('Descriptive Text') }}"  value="{{$creative->description}}"  name="description" required>{{$creative->description}}</textarea>
                            </div>

                            <div class="form-group row">
                                <label>Landing page</label>
                                <input class="form-control"  type="url" placeholder="{{ __('Ad Link') }}"  value="{{$creative->link}}"  name="link" required>
                            </div>
                            <div class="form-group row">
                                <label>Facebook page</label>
                                <input class="form-control" type="url" placeholder="{{ __('Facebook page') }}"  value="{{$creative->facebook_page}}"  name="facebook_page" required>
                            </div>
                            <div class="form-group row">
                                <label>Facebook email</label>
                                <input class="form-control"  type="email" placeholder="{{ __('Facebook email') }}"  value="{{$creative->facebook_email}}"  name="facebook_email" required>
                            </div>
                            <div class="form-group row">
                                <label>Ad Extra Inforamtion</label>
                                <textarea class="form-control" type="text" placeholder="{{ __('Ad Extra Inforamtion') }}"  value="{{$creative->notes}}"  name="notes" required>{{$creative->notes}}</textarea>
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

            @endif
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
        console.log(response)
        file.previewElement.remove();

    },
    removedfile: function (file) {
        console.log("FILE DEL: ",file);
        var request_data = {file_data:{name:file.name,creative:<?=$campaign->creative->id?>}}
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('#creatives_form').find('input[name="ad_media[]"][value="' + name + '"]').remove();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            url: '{{ url("creatives/delete_edit_media") }}',
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
            if (this.files.length > parameters.max) {
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
             let myDropzone = this;
            <!-- 4 -->
            $.get('{{url("creatives/media/$creative->id")}}', function(data) {

                <!-- 5 -->
                $.each(data, function(key,value){

                    // If you only have access to the original image sizes on your server,
                    // and want to resize them in the browser:
                     let mockFile = { name: value.name, size: value.size };
                    myDropzone.displayExistingFile(mockFile, "/files/uploads/"+value.name);

                    // If you use the maxFiles option, make sure you adjust it to the
                    // correct amount:
                    let fileCountOnServer = data.length; // The number of files already uploaded
                    myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
                    $('#creatives_form').append('<input type="hidden" name="ad_media[]" value="' + value.name + '">')


                });

            });



    }
    }



    Dropzone.options.dropzone1 = {
        url: '{{ route('creatives.storeMedia') }}',
        maxFiles: 1,
        maxFilesize: 30, // MB
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    addRemoveLinks: true,
        acceptedFiles: '.jpg,.jpeg,.png',
        success: function (file, response) {

        console.log("RES: ",response);
        $('#creatives_ss_form').append('<input type="hidden" name="ss_media[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
    },
    error: function(file, response)
    {
        console.log(file)
        console.log(response)
        alert(response)
        file.previewElement.remove();

    },
    removedfile: function (file) {
        console.log("FILE DEL: ",file);
        var request_data = {file_data:{name:file.name,creative:<?=$campaign->creative->id?>}}
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('#creatives_ss_form').find('input[name="ss_media[]"][value="' + name + '"]').remove();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: 'POST',
            url: '{{ url("creatives/delete_edit_media") }}',
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
            if (this.files.length > parameters.max) {
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
            $('#creatives_ss_form').append('<input type="hidden" name="ss_media[]" value="' + file.file_name + '">')
        }
        @endif
        let myDropzone = this;
        <!-- 4 -->
        $.get('{{url("creatives/ss/$creative->id")}}', function(data) {

            <!-- 5 -->
            $.each(data, function(key,value){

                // If you only have access to the original image sizes on your server,
                // and want to resize them in the browser:
                let mockFile = { name: value.name, size: value.size };
                myDropzone.displayExistingFile(mockFile, "/files/uploads/"+value.name);

                // If you use the maxFiles option, make sure you adjust it to the
                // correct amount:
                let fileCountOnServer = data.length; // The number of files already uploaded
                myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
                $('#creatives_ss_form').append('<input type="hidden" name="ss_media[]" value="' + value.name + '">')


            });

        });



    }
    }

    $(document).ready(function () {


    });
</script>


@endsection
