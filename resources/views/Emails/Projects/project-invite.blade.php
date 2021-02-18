@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
       You have been added as a collaborator for project <b>{{$data['project_name']}}</b>. Kindly login to your portal to view the project details.
    </p>

@endsection

