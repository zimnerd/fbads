<html>
<head>
    <meta charset="utf-8">
    <title>Hi</title>
</head>
<body>
@if($data->action == "submit_for_review")
<h5>Your campain is pending your review.</h5>
<table class="table table-responsive table-striped">
    <tbody>
    <tr>   <td><strong>Campaign Name</strong></td><td>{{$data->name}}</td></tr>
    <tr>   <td><strong>Submitted By</strong></td><td>{{$data->user->name}}</td></tr>
    <tr>   <td><strong>Budget</strong></td><td>{{$data->budget}}</td></tr>
    <tr>   <td><strong>Location</strong></td><td>{{$data->location}}</td></tr>
    <tr>   <td><strong>From</strong></td><td>{{$data->start}}</td></tr>
    <tr>   <td><strong>Facebook Page</strong></td><td>{{$data->creative->facebook_page}}</td></tr>
    <tr>   <td><strong>Notes</strong></td><td>{{$data->creative->notes}}</td></tr>
    <tr>   <td><strong>Comments</strong></td><td>{{$data->creative->comments}}</td></tr>
    </tbody>
</table>
@endif

@if($data->action == "rejection_reason")
<h5>Your campain has been rejected.</h5>
<table class="table table-responsive table-striped">
    <tbody>
    <tr>   <td><strong>Campaign Name</strong></td><td>{{$data->name}}</td></tr>
    <tr>   <td><strong>Submitted By</strong></td><td>{{$data->user->name}}</td></tr>
    <tr>   <td><strong>Budget</strong></td><td>{{$data->budget}}</td></tr>
    <tr>   <td><strong>Location</strong></td><td>{{$data->location}}</td></tr>
    <tr>   <td><strong>From</strong></td><td>{{$data->start}}</td></tr>
    <tr>   <td><strong>Facebook Page</strong></td><td>{{$data->creative->facebook_page}}</td></tr>
    <tr>   <td><strong>Notes</strong></td><td>{{$data->creative->notes}}</td></tr>
    <tr>   <td><strong>Comments</strong></td><td>{{$data->creative->comments}}</td></tr>
    <tr>   <td style="color:red"><strong>Reason</strong></td><td>{{$data->creative->rejection_reason}}</td></tr>
    </tbody>
</table>
@endif


@if($data->action == "ongoing")
<h4>Your campaign has been published.</h4>
<table class="table table-responsive table-striped">
    <tbody>
    <tr>   <td><strong>Campaign Name</strong></td><td>{{$data->name}}</td></tr>
    <tr>   <td><strong>Submitted By</strong></td><td>{{$data->user->name}}</td></tr>
    <tr>   <td><strong>Budget</strong></td><td>{{$data->budget}}</td></tr>
    <tr>   <td><strong>Location</strong></td><td>{{$data->location}}</td></tr>
    <tr>   <td><strong>From</strong></td><td>{{$data->start}}</td></tr>
    <tr>   <td><strong>Facebook Page</strong></td><td>{{$data->creative->facebook_page}}</td></tr>
    <tr>   <td><strong>Notes</strong></td><td>{{$data->creative->notes}}</td></tr>
    <tr>   <td><strong>Comments</strong></td><td>{{$data->creative->comments}}</td></tr>
    </tbody>
</table>
@endif

<br>
<hr>
<a href="{{config('app.url')."/campaigns/".$data->id}}"  class="btn btn-success btn-lg">View Campaign</a>
<br>
<br>
Yours<br>
FB Ads Planner
</body>
</html>
