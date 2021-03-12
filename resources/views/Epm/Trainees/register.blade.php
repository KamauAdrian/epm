@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        Trainees attendance register
    </div>
@endsection
