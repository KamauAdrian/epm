@extends('Emails.master')

@section('title')
    <h3>Hi {{$data['name']}},</h3>
@endsection

@section('content')
    <p>Welcome to eMobilis Portal!</p><br />
    <p>The Mission of eMobilis is to create opportunities for  African
    Youth by Training them on digital, software and other technologies that prepare them
    for the Future of Work by equipping them with marketable; industry driven skills.
    </p><br>
    <p>Below are your Account Details:</p><br />
    <p>Email: {{$data['email']}}</p>
    <p>Phone Number: {{$data['phone']}}</p><br />
{{--    <a href="{{url('/account/activate',$data['user_id'])}}" style="background-color:#333333; border:1px solid #333333; border-color:#333333; border-radius:0px; border-width:1px; color:#ffffff; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 30px 12px 30px; text-align:center; text-decoration:none; border-style:solid;" target="_blank">Click Here To Activate Your Account</a>--}}
    <a href="{{url('/account/activate',$data['user_id'])}}" class="btn btn-outline-info" target="_blank">Click Here To Activate Your Account</a>
@endsection



{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<?php--}}
{{--$id = $data['user_id'];--}}
{{--?>--}}
{{--<h3>--}}
{{--    Hi {{$data['name']}},--}}
{{--</h3>--}}
{{--<p>Welcome to eMobilis Portal!</p>--}}
{{--<p>The Mission of eMobilis is to create opportunities for--}}
{{--    African Youth by Training them on digital, software and--}}
{{--    other technologies that prepare them for the Future of--}}
{{--    Work by equipping them with marketable; industry--}}
{{--    driven skills.--}}
{{--</p>--}}
{{--<p>--}}
{{--    Below are your Account Details:--}}
{{--</p>--}}
{{--<p>Email: {{$data['email']}} <br /> Phone: {{$data['phone']}}</p>--}}
{{--<p>--}}
{{--    <a href="{{url('/account/activate',$id)}}">Click here to active your Account and set a Password.</a>--}}
{{--</p>--}}
{{--</body>--}}
{{--</html>--}}
