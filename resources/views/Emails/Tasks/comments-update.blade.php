@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        {{$data['comment_creator']}} Just commented on task <b>{{$data['task']}}</b>. Please login to your account to view Comments.
    </p>

@endsection

