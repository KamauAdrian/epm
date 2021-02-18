@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        {{$data['message']}}
    </p>

@endsection

