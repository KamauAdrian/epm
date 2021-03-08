@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Training Day {{$day}}</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                {{--                @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")--}}
                {{--                    <a href="{{url("/adm/".$auth_admin->id."/edit/training/".$training->id."/day/".$trainingDay->id)}}">--}}
                {{--                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Edit</button>--}}
                {{--                    </a>--}}
                {{--                @endif--}}
                {{--                <a href="#!">--}}
                {{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
                {{--                </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                <?php
                $auth_admin = auth()->user();
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableListDataTableA" class="table table-borderless table-center mb-0 ">

                                <thead>
                                <tr class="text-center">
                                    <th colspan="6">Training Sessions Allocation</th>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <th>Session</th>
                                    <th>Facilitators</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function (){
            $("#tableListDataTableA").DataTable();
        });
    </script>
@endsection
