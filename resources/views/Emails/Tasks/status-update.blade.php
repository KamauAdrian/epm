@extends('Emails.master')

@section('title','Hi '.$data['name'])

@section('content')

    <p>
        Task <b>{{$data['task']}}</b> has been marked as {{$data['message']}}

    </p>

@endsection

