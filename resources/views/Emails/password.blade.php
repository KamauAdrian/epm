<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$id = $data['user_id'];
?>
<h2>
    Hi {{$data['name']}},Following are your account details: <br>
</h2>
<h3>Email: </h3>
<p>
    {{$data['email']}}
</p>
<h3>Phone: </h3><p>{{$data['phone']}}</p>

<h4>
    <a href="{{url('/account/activate',$id)}}"> Click here to activate your account</a>
</h4>
</body>
</html>
