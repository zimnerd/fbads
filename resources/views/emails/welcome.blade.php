<html>
<head>
    <meta charset="utf-8">
    <title>Welcome</title>
</head>
<body>
<h2> Hi {{$data['name']}}, we have registered your account! Following are your account details: <br>
</h2>
<h3>Email/Username: </h3>
<p>{{$data['email']}}</p>
<h3>Name: </h3>
<p>{{$data['name']}}</p>
<h3>Password: </h3>
<p>{{$data['password']}}</p>
<h3>Organisation: </h3>
<p>{{$data['organisation']}}</p>
</body>
</html>
