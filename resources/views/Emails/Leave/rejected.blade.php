@extends('Emails.master')

@section('title','Hi '.$data['applicant_name'])

@section('content')
    <p>Your Leave Application Request Has Been Rejected.</p>
    {{$data['reason']}}
@endsection
