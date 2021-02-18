@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
       You have been added by  {{$data['creator_name']}} as a collaborator for project <b>{{$data['project_name']}}</b>. Kindly login to your portal to view the project details.
        <button class="btn btn-icon" >{{$data['creator_initials']}}</button>
    </p>

@endsection

