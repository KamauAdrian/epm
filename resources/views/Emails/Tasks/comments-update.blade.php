@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        {{$data['collaborator']->name}} Just commented on task {{$data['task']->name}}. Please login to your account to view the Comments
    </p>

@endsection

