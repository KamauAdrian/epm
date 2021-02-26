@extends('Epm.layouts.master')

@section('content')
    @include('Epm.layouts.center-view')
@endsection

@section('content')
    <script>
        $(document).ready(function (){
            $("#cmsListTable").dataTable({
                "order":[],
            })
        });
    </script>
@endsection
