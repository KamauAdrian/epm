@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        {{$data['attachment_creator']}} Just added a new attachment to task <b>{{$data['task']}}</b>. Please login to your account to view the attachment.
    </p>

@endsection

