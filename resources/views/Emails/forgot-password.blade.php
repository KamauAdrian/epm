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
$token = '';
$split_token = explode('/',$data['session_verification']);
if (count($split_token)>1){
    $token = $split_token[0];
}else{
    $token = $data['session_verification'];
}
?>
<h2>
    Hi {{$data['name']}}, <br>
</h2>
<h4>
    <a href="{{url('/'.$token.'/'.$id)}}"> Click here to reset your password</a>
</h4>
</body>
</html>
