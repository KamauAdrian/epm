@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        {{$data['link_creator']}} Just added a new link to task <b>{{$data['task']}}</b>. Please login to your account to view the link.
    </p>

@endsection

