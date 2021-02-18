@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        {{$data['collaborator']}} Just commented on task {{$data['task']}}. Please login to your account to view the Comments
    </p>

@endsection

