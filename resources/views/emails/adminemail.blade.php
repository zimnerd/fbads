<html>
<head>
    <meta charset="utf-8">
    <title>Hi Admin</title>
</head>
<body>
<h3>Hi Admin</h3>
@if($data->action == "new_ad")
<h4>You have a new campaign.</h4>

<table class="table table-responsive table-striped">
    <tbody>
    <tr>   <td><strong>Campaign Name</strong></td><td>{{$data->name}}</td></tr>
    <tr>   <td><strong>Submitted By</strong></td><td>{{$data->user->name}}</td></tr>
    <tr>   <td><strong>Submitted By Email</strong></td><td>{{$data->user->email}}</td></tr>
    <tr>   <td><strong>Budget</strong></td><td>{{$data->budget}}</td></tr>
    <tr>   <td><strong>Location</strong></td><td>{{$data->location}}</td></tr>
    <tr>   <td><strong>From</strong></td><td>{{$data->start}}</td></tr>
    <tr>   <td><strong>Facebook Page</strong></td><td>{{$data->creative->facebook_page}}</td></tr>
    <tr>   <td><strong>Notes</strong></td><td>{{$data->creative->notes}}</td></tr>
    </tbody>
</table>


@endif


@if($data->action == "comments")
<h4>You have a new campain comments.</h4>
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


@if($data->action == "ready")
<h4>The campaign has been aproved.</h4>
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
