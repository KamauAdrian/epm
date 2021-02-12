@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')
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
    <p>Follow The Instruction Below To Reset a Password For Your Account
    </p><br>
    <div style="font-family: inherit; text-align: center">
    <a href="{{url('/'.$token.'/'.$id)}}" class="btn btn-outline-info" target="_blank">Reset Password</a>
    </div>
{{--    style="background-color:#333333; border:1px solid #333333; border-color:#333333; border-radius:0px; border-width:1px; color:#ffffff; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 30px 12px 30px; text-align:center; text-decoration:none; border-style:solid;"--}}
@endsection

