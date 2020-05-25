<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/ion.rangeSlider.min.css') }}" rel="stylesheet">
@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $campaign->name }}
                    </div>
                    <div class="card-body  mx-3">
                        <form method="POST" action="/campaigns/{{ $campaign->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group   col-md-6 {{ $errors->has('name') ? 'border-danger rounded' : ''}}">
                                <label>Campaign Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}"
                                       value="{{$campaign->name}}" name="name" required autofocus>
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('goal_id') ? 'border-danger rounded' : ''}}">
                                <label>Marketing Goal</label>
                                <select class="form-control goals" name="goal_id" required>
                                    <option value="">Select Marketing Goal</option>
                                    @foreach($goals as $goal)
                                    <option value="{{ $goal->id }}" @if($goal->id == $campaign->goal->id)
                                        selected="selected" @endif>{{ $goal->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-6 {{ $errors->has('objective_id') ? 'border-danger rounded' : ''}}">
                                <label>Campaign Objetive</label>
                                <select class="form-control objectives" name="objective_id" required>
                                    <option value="">Select Objetive</option>
                                    @foreach($objectives as $objective)
                                    <option value="{{ $objective->id }}" @if($objective->id == $campaign->objective->id)
                                        selected="selected" @endif>{{ $objective->description }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group   col-md-6 {{ $errors->has('start') ? 'border-danger rounded' : ''}}">
                                <label>Start Date</label>
                                <input class="form-control" type="date" placeholder="{{ __('Start Date') }}"
                                       value="{{ date('yy-m-d', strtotime($campaign->start)) }}" name="start" required>

                            </div>
                            <div class="row"
                                 style="padding: 10px; margin:20px 0; background-color: #f0f0f0; border: 1px solid #dedede">
                                <div class="col-md-6">

                                    <!--                                Field to type in autocompleted address-->
                                    <div class="form-group {{ $errors->has('location') ? 'border-danger rounded' : ''}}" id="locationField">
                                        <label for="locationField">Geo Targeting</label>
                                        <input id="autocomplete"
                                               placeholder="Address / Area name / Region"
                                               onFocus="geolocate()"
                                               type="text"
                                               name="location"
                                               class="form-control"
                                               value="{{ $campaign->location }}"
                                               required>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-10 {{ $errors->has('radius') ? 'border-danger rounded' : ''}}">
                                            <label for="customRange3">Radius Range</label>
                                            <input type="range" class="form-control  custom-range" min="10" max="4000"
                                                   step="100" id="mapRadiusSlider" value="100"
                                                   onchange="updateTextInput(this.value);">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="customRange3">Selected Radius</label>
                                            <input type="number"
                                                   class="form-control "
                                                   name="radius"
                                                   id="mapRadius"
                                                   value="{{ $campaign->radius }}" readonly>
                                        </div>
                                    </div>
                                    <!--                                Hidden fields where the lattitude and longitude is saved-->
                                    <input type="hidden" name="address_latitude" id="address_latitude" value="0"/>
                                    <input type="hidden" name="address_longitude" id="address_longitude" value="0"/>

                                    <!--                                Fields that get autocompleted-->
                                    <div class="form-row" id="address">
                                        <div class="form-group col-md-2">
                                            <label class="label text-sm">Street Number</label>
                                            <input type="text" class="field form-control" id="street_number"
                                                   name="street_number" disabled="true">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="label text-sm">Street Name</label>
                                            <input type="text" class="field form-control" id="route" name="route"
                                                   disabled="true" placeholder="123 Main Street">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="label text-sm">City</label>
                                            <input type="text" class="field form-control" id="locality" disabled="true"
                                                   name="locality" placeholder="City">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="label text-sm">Province</label>
                                            <input type="text" class="field form-control"
                                                   id="administrative_area_level_1"
                                                   disabled="true" name="administrative_area_level_1"
                                                   placeholder="Province">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="label text-sm">Zip code</label>
                                            <input type="text" class="field form-control" id="postal_code"
                                                   disabled="true"
                                                   name="postal_code" placeholder="Zip">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="label text-sm">Country</label>
                                            <input type="text" class="field form-control" id="country"
                                                   disabled="true"
                                                   name="country" placeholder="Country">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--                                Displays the map-->
                                    <div class="form-row">
                                        <div id="map" style="width:100%;height:400px;"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('gender') ? 'border-danger rounded' : ''}}">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="all" @if(
                                    "all"== $campaign->gender) selected="selected" @endif>All</option>
                                    <option value="Male" @if(
                                    "Male"== $campaign->gender) selected="selected" @endif>Male</option>
                                    <option value="Female" @if(
                                    "Female" == $campaign->gender) selected="selected" @endif>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6  {{ $errors->has('age_range') ? 'border-danger rounded' : ''}}">
                                <option value="">Select Age Range</option>
                                <input type="text" class="js-range-slider" value=""/>
                            </div>

                            <input type="hidden" name="age_range" value="" id="age_range"/>
                            <div class="form-group col-md-6 {{ $errors->has('interest_id') ? 'border-danger rounded' : ''}}">
                                <label>Interests</label>
                                <select class="form-control objectives select2" name="interest_id" required>
                                    <option value="">Select Target Interests</option>
                                    @foreach($interests as $interest)
                                    <option value="{{ $interest->id }}" @if($interest->id == $campaign->interest->id)
                                        selected="selected" @endif>{{ $interest->description }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6  {{ $errors->has('name') ? 'border-danger rounded' : ''}}">
                                <label>Other Interests <small>(Optional)</small></label>
                                <input class="form-control" type="text" value="{{ old('other_interests') }}"
                                       placeholder="{{ __('Other Interests') }}" name="other_interests">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6   {{ $errors->has('media_type') ? 'border-danger rounded' : ''}}">
                                    <label>Select Ad format / Media Type</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card normalize-header" onclick="showVideo('link')" id="link">
                                                <!---->
                                                <div class="card-header">
                                                    <div>Link</div>

                                                    <small>Suitable for
                                                        focusing on one specific product or service
                                                    </small>
                                                </div>
                                                <div class="card-block"><!----><!---->
                                                    <div class="img normalize-swiper image"><img
                                                            src="../../assets/img/link.png"
                                                            style="width: 100%; height: auto;">
                                                    </div>
                                                </div><!----></div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card normalize-header" onclick="showVideo('carousel')" id="carousel">
                                                <!---->
                                                <div class="card-header">
                                                    <div>Carousel</div>
                                                    <small>Suitable for
                                                        multiservice or multiproduct messaging
                                                    </small>
                                                </div>
                                                <div class="card-block"><!----><!---->
                                                    <div class="img normalize-swiper carousel"><img
                                                            src="../../assets/img/carousel.png"
                                                            style="width: 100%; height: auto;">
                                                    </div>
                                                </div><!----></div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card normalize-header" onclick="showVideo('slideshow')" id="slideshow">
                                                <!---->
                                                <div class="card-header">
                                                    <div>Slideshow</div>

                                                    <small>Suitable fo Multiservice or multiproduct awareness
                                                    </small>
                                                </div>
                                                <div class="card-block"><!----><!---->
                                                    <div class="img normalize-swiper slideshow"><img
                                                            src="../../assets/img/slideshow.png"
                                                            style="width: 100%; height: auto;">
                                                    </div>
                                                </div><!----></div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card normalize-header" onclick="showVideo('video')" id="video"><!---->
                                                <div class="card-header">
                                                    <div>Video</div>
                                                    <small>Suitable for Be at the centre of daily discovery
                                                    </small>
                                                </div>
                                                <div class="card-block"><!----><!---->
                                                    <div class="img normalize-swiper video"><img
                                                            src="../../assets/img/video.png"
                                                            style="width: 100%; height: auto;">
                                                    </div>
                                                </div><!----></div>
                                        </div>
                                    </div>
                                    {!! $errors->first('media_type', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <div class="col-md-6">
                                    <div class="row">


                                        <div class="col-md-12" id="linkSection">
                                            <div class="row">
{{--                                                <div class="col-md-4">--}}
{{--                                                    <video width="80%" controls id="linkVideo">--}}
{{--                                                        <source src="../../assets/video/link.mp4" type="video/mp4">--}}
{{--                                                        Your browser does not support HTML5 video.--}}
{{--                                                    </video>--}}
{{--                                                </div>--}}
                                                <div class="col-md-8">
                                                    <h5>Link</h5>

                                                    <h6>Most suitable for:</h6>

                                                    <p>Broad business messaging</p>
                                                    <p>Focus on one specific product or service</p>
                                                    <p> Single image</p>
                                                    <p>Single landing page</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="carouselSection">
                                            <div class="row">
{{--                                                <div class="col-md-4">--}}
{{--                                                    <video width="80%" controls id="carouselVideo">--}}
{{--                                                        <source src="../../assets/video/carousel.mp4" type="video/mp4">--}}
{{--                                                        Your browser does not support HTML5 video.--}}
{{--                                                    </video>--}}
{{--                                                </div>--}}
                                                <div class="col-md-8">

                                                    <h5>Carousel</h5>

                                                    <h6>Most suitable for:</h6>

                                                    <p>Multiservice or multiproduct messaging</p>
                                                    <p>Max 5 images</p>
                                                    <p> Max 5 landing pages</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12" id="slideshowSection">
                                            <div class="row">
{{--                                                <div class="col-md-4">--}}
{{--                                                    <video width="80%" controls id="slideVideo">--}}
{{--                                                        <source src="../../assets/video/slideshow.mp4" type="video/mp4">--}}
{{--                                                        Your browser does not support HTML5 video.--}}
{{--                                                    </video>--}}
{{--                                                </div>--}}
                                                <div class="col-md-8">
                                                    <h5>Slideshow</h5>

                                                    <h6>Most suitable for:</h6>
                                                    <p> Multiservice or multiproduct awareness</p>
                                                    <p>Min 3, max 10 images</p>
                                                    <p>Engaging users with a looping video</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="videoSection">
                                            <div class="row">
{{--                                                <div class="col-md-4">--}}
{{--                                                    <video width="80%" controls id="videoVideo">--}}
{{--                                                        <source src="../../assets/video/video.mp4" type="video/mp4">--}}
{{--                                                        Your browser does not support HTML5 video.--}}
{{--                                                    </video>--}}
{{--                                                </div>--}}
                                                <div class="col-md-8">

                                                    <h5>Video</h5>

                                                    <h6>Most suitable for:</h6>

                                                    <p>Be at the centre of daily discovery</p>
                                                    <p>Reach people across devices</p>
                                                    <p>Format: .MOV, .MP4, .AVI or .GIF files</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="media_type" id="mediaType">
                            <div class="form-group col-md-6">
                                <label>Campaign Duration</label>
                                <select class="form-control {{ $errors->has('ad_period') ? 'border-danger rounded' : ''}}" name="ad_period" required>
                                    <option value="">Select Mode</option>
                                    <option value="1" @if(
                                    "1" == $campaign->ad_period ) selected="selected" @endif>Once Off</option>
                                    <option value="3" @if(
                                    "3" == $campaign->ad_period) selected="selected" @endif>3 Months</option>
                                    <option value="6" @if(
                                    "6" == $campaign->ad_period ) selected="selected" @endif>6 Months</option>
                                    <option value="9" @if(
                                    "9" == $campaign->ad_period ) selected="selected" @endif>9 Months</option>
                                    <option value="12" @if(
                                    "12"==$campaign->ad_period) selected="selected" @endif>12 Months</option>
                                </select>

                            </div>

                            <div class="form-group   col-md-6">
                                <label>Status</label>
                                <select class="form-control" name="status_id" readonly>
                                    @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" @if ($status->id == $campaign->status->id)
                                        selected="selected"
                                        @endif>{{ $status->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group   col-md-6 {{ $errors->has('budget') ? 'border-danger rounded' : ''}}">
                                <label>Budget</label>
                                <input class="form-control" value="{{$campaign->budget}}" type="number"
                                       placeholder="{{ __('Daily budget') }}" name="budget" required>
                            </div>

                            <div class="row">
                                <div class="col-md-3">

                                    <a href="{{ route('campaigns.index') }}" class="btn btn-lg btn-info float-left">{{
                                        __('Return') }}</a>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-lg btn-success float-right" type="submit">{{ __('Continue') }}
                                    </button>
                                </div>
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

<script src="{{ asset('js/select2.min.js') }}" defer></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHr7l5ZjZE9msgaMGYTah_1JW6Y6JV5E8&libraries=places&callback=initMap"
    async bdefer></script>
<script>
    $(document).ready(function () {
        var ageFrom;
        var ageTo;
        var age_range = "<?=$campaign->age_range?>";
        var media_type = "<?=$campaign->media_type->name?>";
        $("#"+media_type+"").trigger("click");
        showVideo(media_type);
        age_range = age_range.split("-");
        ageFrom = parseInt(age_range[0]);
        ageTo = parseInt(age_range[1]);
        $("#age_range").val(ageFrom + "-" + ageTo);
        $("#carouselSection").hide()
        $("#carouselVideo").hide();
        $("#linkSection").hide();;
        $("#linkVideo").hide();
        $("#videoSection").hide()
        $("#videoVideo").hide();
        $("#slideshowSection").hide();;
        $("#slideshowVideo").hide();
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 16,
            max: 120,
            from: ageFrom,
            to: ageTo,
            grid: true,
            onStart: function (data) {
                // Called right after range slider instance initialised
                ageFrom = data.from;
                ageTo = data.to;
                $("#age_range").val(ageFrom + "-" + ageTo);
                console.log(data.input);        // jQuery-link to input
                console.log(data.slider);       // jQuery-link to range sliders container
                console.log(data.min);          // MIN value
                console.log(data.max);          // MAX values
                console.log(data.from);         // FROM value
                console.log(data.from_percent); // FROM value in percent
                console.log(data.from_value);   // FROM index in values array (if used)
                console.log(data.to);           // TO value
                console.log(data.to_percent);   // TO value in percent
                console.log(data.to_value);     // TO index in values array (if used)
                console.log(data.min_pretty);   // MIN prettified (if used)
                console.log(data.max_pretty);   // MAX prettified (if used)
                console.log(data.from_pretty);  // FROM prettified (if used)
                console.log(data.to_pretty);    // TO prettified (if used)
            },

            onChange: function (data) {
                // Called every time handle position is changed
                ageFrom = data.from;
                ageTo = data.to;
                $("#age_range").val(ageFrom + "-" + ageTo);
                console.log(data.from);
            },

            onFinish: function (data) {
                // Called then action is done and mouse is released
                ageFrom = data.from;
                ageTo = data.to;
                $("#age_range").val(ageFrom + "-" + ageTo);
                console.log(data.to);
            },

            onUpdate: function (data) {
                // Called then slider is changed using Update public method
                ageFrom = data.from;
                ageTo = data.to;
                $("#age_range").val(ageFrom + "-" + ageTo);
                console.log(data.from_percent);
            }
        });

        $('.select2').select2();
        $('.ad_format').click(function () {
            if ($(this).is(':checked')) {
                $('#min_bid').text($(this).data('bid'));
            }
        });
    });
    //Variables for displaying the address on the map
    let map;
    let service;
    let infowindow;
    let pos;
    var currentLocation;
    var placeSearch, autocomplete;
    var place;
    var radius = <?=$campaign->radius?>;
    var zoom;

    //The variables you want to recieve from Google
    //when the address is selected
    let componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        country: 'long_name',
        administrative_area_level_1: 'long_name',
        postal_code: 'short_name'
    };

    function updateTextInput(val) {
        document.getElementById('mapRadius').value = val;
        radius = val + val / 2;
        var zoomLevel = parseInt(16 - Math.log(radius / 500) / Math.log(2));
        fillInAddress(zoomLevel);
    }

    function initMap() {
        var locationData = <?=$campaign->location_metadata?>;

        console.log(locationData);
        console.log(locationData.address_latitude);
        console.log(locationData.address_longitude);
        infowindow = new google.maps.InfoWindow();
        //Finds your current location and displays it on the map
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    currentLocation = new google.maps.LatLng(pos.lat, pos.lng);
                    map = new google.maps.Map(document.getElementById("map"), {
                        center: currentLocation,
                        zoom: 10
                    })
                },
                function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
//Calls function that autocompletes form
        initAutocomplete();
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {types: ['geocode']});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component', 'geometry']);


        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress(zoomLevel = 16) {
        // Get the place details from the autocomplete object.
        place = autocomplete.getPlace();
        console.log(place);
        console.log(componentForm);
        let level = place.address_components.length;
        if(level < 3){
            zoomLevel = 5;
            $("#mapRadiusSlider,#mapRadius").prop("disabled",true);
            $("#mapRadius").val("0");
        }else{
            $("#mapRadiusSlider,#mapRadius").prop("disabled",false);
        }

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            console.log(addressType);
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }

        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();
        document.getElementById('address_latitude').value = lat;
        document.getElementById('address_longitude').value = lng;

        //Map zooms in to the location given
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: +lat, lng: +lng},
            zoom: zoomLevel
        });

        //Map marker is created and displays address
        var marker = new google.maps.Marker({
            map: map,
            position: {lat: +lat, lng: +lng}
        });
        google.maps.event.addListener(marker, "click", function () {
            infowindow.setContent(document.getElementById('autocomplete').value);
            infowindow.open(map, this);
        });

        if (level > 2) {
            // Add the circle for this city to the map.
            var cityCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: {lat: lat, lng: lng},
                radius: parseInt(radius)
            });
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle(
                    {center: geolocation, radius: position.coords.accuracy});
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }


    function showVideo(section) {
        var myVideo;
        console.log(section)
        $("#" + section + "").addClass("active_card");
        $("#mediaType").val(section);
        if (section === "link") {
            $("#carousel,#video,#slideshow").removeClass("active_card");
            $("#carouselVideo").hide();
            $("#carouselSection").hide();
            $("#linkVideo").show();
            $("#linkSection").show();
            $("#videoVideo").hide();
            $("#videoSection").hide();
            $("#slideshowVideo").hide();
            $("#slideshowSection").hide();
            myVideo = document.getElementById("linkVideo");
        }
        if (section === "carousel") {
            $("#link,#video,#slideshow").removeClass("active_card");
            $("#carouselVideo").show();
            $("#carouselSection").show();
            $("#linkVideo").hide();
            $("#linkSection").hide();
            $("#videoVideo").hide();
            $("#videoSection").hide();
            $("#slideshowVideo").hide();
            $("#slideshowSection").hide();
            myVideo = document.getElementById("carouselVideo");
        }

        if (section === "video") {
            $("#link,#carousel,#slideshow").removeClass("active_card");
            $("#carouselVideo").hide();
            $("#carouselSection").hide();
            $("#linkVideo").hide();
            $("#linkSection").hide();
            $("#videoVideo").show();
            $("#videoSection").show();
            $("#slideshowVideo").hide();
            $("#slideshowSection").hide();
            myVideo = document.getElementById("videoVideo");
        }

        if (section === "slideshow") {
            $("#link,#video,#carousel").removeClass("active_card");
            $("#carouselVideo").hide();
            $("#carouselSection").hide();
            $("#linkVideo").hide();
            $("#linkSection").hide();
            $("#videoVideo").hide();
            $("#videoSection").hide();
            $("#slideshowVideo").show();
            $("#slideshowSection").show();
            myVideo = document.getElementById("slideshowlVideo");
        }


        // if (myVideo.paused)
        //     myVideo.play();
        // else
        //     myVideo.pause();

    }
</script>
<script src="{{ asset('js/ion.rangeSlider.min.js') }}" defer></script>
@endsection
