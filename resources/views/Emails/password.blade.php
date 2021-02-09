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
<h3>
    Hi {{$data['name']}},
</h3>
<p>Welcome to eMobilis Portal!</p>
<p>The Mission of eMobilis is to create opportunities for
    African Youth by Training them on digital, software and
    other technologies that prepare them for the Future of
    Work by equipping them with marketable; industry
    driven skills.
</p>
<p>
    Below are your Account Details:
</p>
<p>Email: {{$data['email']}} <br /> Phone: {{$data['phone']}}</p>
<p>
    <a href="{{url('/account/activate',$id)}}">Click here to active your Account and set a Password.</a>
</p>
</body>
</html>
