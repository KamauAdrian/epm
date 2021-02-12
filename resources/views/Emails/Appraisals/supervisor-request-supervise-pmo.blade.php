@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        Please log in to your account and supervise {{$data['pmo']}} performance appraisal in the reports section.
    </p><br>

@endsection





