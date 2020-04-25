<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
    <div class="animated fadeIn">


        <div class="row">
            <table class="table table-responsive table-bordered table-striped" width="100%" border="1" align="top" cellpadding="0" cellspacing="0" >
                <tbody>
                <tr style="background-color: #1e3041; color: #ffffff">
                <th colspan="4">
                    <h2 class="card-title"><strong>Campaign title: </strong> {{$campaign->name}} Report</h2>
                </th>
                </tr>
                <tr>
                    <td width="50%" colspan="2">
                        <strong>Creator: </strong> {{$campaign->user->name}}<br>
                        <strong>Company: </strong> {{$campaign->user->organisation}}<br>
                        <strong>Budget: </strong> {{$campaign->budget}}<br>
                        <strong>Goal type: </strong> {{$campaign->goal->name}}<br>
                        <strong>Mode : </strong> {{$campaign->ad_period}} Months<br>
                        <strong>Locations: </strong> {{$campaign->location}}<br>
                        <strong>Radius: </strong> {{$campaign->radius}}<br>
                        <strong>Gender: </strong> {{$campaign->gender}}<br>
                        <strong>Age: </strong> {{$campaign->age_range}}<br>
                        <strong>Interest: </strong> {{$campaign->interest->description}}<br>
                        <strong>Ad Format: </strong> {{$campaign->media_type->name}}<br>
                        <strong>Facebook Page: </strong>{{$campaign->creative->facebook_page}}<br>
                        <strong>Facebook Email: </strong>{{$campaign->creative->facebook_email}}<br>
                        <strong>Landing Page: </strong> {{$campaign->creative->link}}<br>
                        <strong>Start date : </strong> {{$campaign->start}}<br>
                    </td>
                    <td width="50%" colspan="2">
                        @foreach($campaign->creative->media as $adfile)
                        @if($adfile->image_path !== null)
                        <img class="card-img-top" width="250" src="{{$adfile->image_path}}" alt="{{$adfile->name}}"><br>
                        @elseif($adfile->video_path !== null)
                        <video width="400" controls id="carouselVideo">
                            <source src="{{$adfile->video_path}}" type="video/mp4">
                        </video><br>
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td><strong>People Reached</strong>
                        <p>The number of users who have seen your ads</p></td>
                    <td>{{$campaign->creative->reach}}</td>
                    <td><strong>Frequency</strong>
                        <p>The number of times your ad has been seen on average by each user</p></td>
                    <td>{{$campaign->creative->frequency}}</td>
                </tr>
                <tr>
                    <td scope="row"><strong>Video views </strong>
                        <p>How many times the video featured in your ad was viewed</p></td>
                    <td>{{$campaign->creative->video_views}}</td>
                    <td scope="row"><strong>Total clicks</strong>
                        <p>The total number of times user clicked anywhere on your ad</p></td>
                    <td>{{$campaign->creative->clicks}}</td>
                </tr>
                <tr>
                    <td scope="row"><strong>Engagement Rate</strong>
                        <p>How many interactions your ad received out of people who saw it</p></td>
                    <td>{{$campaign->creative->engagement_rate}}</td>
                    <td scope="row"><strong>Impressions</strong>
                        <p>The total number of times your ad has
                            been seen by all users</p></td>
                    <td>{{$campaign->creative->reach}}</td>
                </tr>

                </tbody>
            </table>


        </div>

    </div>


