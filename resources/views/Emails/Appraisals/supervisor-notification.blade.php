@extends('Emails.master')

@section('title','Hi '.$supervisor['name'])

@section('content')

    <p>
       Please log in to your account and submit Supervisor performance appraisal for  {{$pmo['name']}}.
    </p><br>

@endsection


