<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>
    #campdetails p
    {
        margin: 2px 10px;
        padding: 2px;
        border-bottom: 1px solid #dedede;
    }

    #campdetails p strong
    {
        min-width: 200px;
    }

    .margin10 p
    {
        margin: 5px 10px;
    }

    .margin10 h3
    {
        border-bottom: 2px solid rgba(27, 80, 143, 0.24);
    }

    .margin10 h2, .margin10 h1, .margin10 h3, p strong
    {
        margin: 10px 15px;
        color: #1b508f;
    }

    .margin10
    {
        border-bottom: 1px solid #dedede;
    }

    h1, h2, h5
    {
        text-align: center;
    }

    .margin10 td
    {
        border-bottom: 1px solid #dedede;

    }

    .margin10 td:nth-child(4), .margin10 td:nth-child(2)
    {
        border-bottom: 1px solid #dedede;
        border-right: 1px solid #dedede;

    }

    body
    {
        font-family: Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        font-size: 1rem;
    }


</style>
<div class="container-fluid">
    <div class="animated fadeIn">

        <div class="row">
            <table class="table table-responsive table-bordered table-striped" width="100%" align="middle" cellpadding="0" cellspacing="0" style="border:1px solid #dedede; border-radius:5px; margin-left:auto;margin-right:auto;">
                <tbody style="border :1px solid #dedede; border-radius: 5px">
                <tr style="background-color: #1b508f; color: #ffffff">
                    <th colspan="4">
                        <h2 class="card-title"><strong>Campaign: </strong> {{$campaign->name}} Report</h2>
                    </th>
                </tr>
                <tr>
                    <td colspan="3" id="campdetails">
                        <br>
                        <p><strong>Creator: </strong> {{$campaign->user->name}}</p>
                        <p><strong>Company: </strong> {{$campaign->user->organisation}}</p>
                        <p><strong>Budget: </strong> {{$campaign->budget}}</p>
                        <p><strong>Goal type: </strong> {{$campaign->goal->name}}</p>
                        <p><strong>Mode : </strong> {{$campaign->ad_period}} Months</p>
                        <p><strong>Locations: </strong> {{$campaign->location}}</p>
                        <p><strong>Radius: </strong> {{$campaign->radius}}</p>
                        <p><strong>Gender: </strong> {{$campaign->gender}}</p>
                        <p><strong>Age: </strong> {{$campaign->age_range}}</p>
                        <p><strong>Interest: </strong> {{$campaign->interest->description}}</p>
                        <p><strong>Ad Format: </strong> {{$campaign->media_type->name}}</p>
                        <p><strong>Facebook Page: </strong>{{$campaign->creative->facebook_page}}</p>
                        <p><strong>Facebook Email: </strong>{{$campaign->creative->facebook_email}}</p>
                        <p><strong>Landing Page: </strong> {{$campaign->creative->link}}</p>
                        <p><strong>Start date : </strong> {{$campaign->start}}</p>
                    </td>
                    <td colspan="1">
                        @foreach($campaign->creative->media as $adfile)
                            @if($adfile->screenshot_path !== NULL)
                                <h2>Ad Screenshot</h2>
                                <img class="card-img-top" src="{{$adfile->screenshot_path}}" width="200" alt="{{$adfile->name}}" style="border-radius: 5px; max-width: 250px;"><br>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><br><br></td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: #dedede; height: 5px; margin: 5px"></td>
                </tr>
                <tr class="margin10">
                    <td width="25%"><h3>People Reached</h3>
                        <p>The number of users who have seen your ads</p></td>
                    <td width="25%"><h1>{{$campaign->creative->reach}}</h1></td>
                    <td scope="row" width="25%"><h3>Total clicks</h3>
                        <p>The total number of times user clicked anywhere on your ad</p></td>
                    <td width="25%"><h1>{{$campaign->creative->clicks}}</h1></td>
                </tr>

                @if ($campaign->media_type->name =="video")
                    <tr class="margin10">
                        <td width="25%"><h3>Frequency</h3>
                            <p>The number of times your ad has been seen on average by each user</p></td>
                        <td width="25%"><h1>{{$campaign->creative->frequency}}</h1></td>
                        <td scope="row" width="25%"><h3>Video views </h3>
                            <p>How many times the video featured in your ad was viewed</p></td>
                        <td width="25%"><h1>{{$campaign->creative->video_views}}</h1></td>

                    </tr>
                @endif
                <tr class="margin10">
                    <td scope="row" width="25%"><h3>Engagement</h3>
                        <p>How many interactions your ad received out of people who saw it</p></td>
                    <td width="25%"><h1>{{$campaign->creative->engagement_rate}}</h1></td>
                    <td scope="row" width="25%"><h3>CTR</h3>
                        <p>Click through rate</p></td>
                    <td width="25%"><h1>{{$campaign->creative->ctr}}</h1></td>
                </tr>

                </tbody>
            </table>


        </div>

    </div>
</div>
