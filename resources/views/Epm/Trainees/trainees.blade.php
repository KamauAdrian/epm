@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 mb-2">
                <h1 class="d-inline-block mb-0 font-weight-normal">Trainees List</h1>
{{--                <a href="{{url('/adm/'.$auth_admin->id.'/submit/daily/attendance/report')}}" class="float-right">--}}
{{--                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Submit Attendance</button>--}}
{{--                </a>--}}
            </div>
            <div class="col-md-12">
                <center>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="text-success"><h5>{{session()->get('success')}}</h5></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="text-danger"><h5>{{session()->get('error')}}</h5></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </center>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="traineesList" class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Gender</th>
                                    <th>Category</th>
                                    <th class="text--right">Actions</th>
                                </tr>
                                </thead>
                                @if($trainees)
                                    <tbody>
                                    @foreach($trainees as $trainee)
                                        <tr>
                                            <td>{{$trainee->name}}</td>
                                            <td>{{$trainee->email}}</td>
                                            <td>{{$trainee->phone_number}}</td>
                                            <td>{{$trainee->gender}}</td>
                                            <td>{{$trainee->category}}</td>
                                            <td class="text-right">
                                                <div class="float-right">
                                                    <a href="#!" class="btn btn-sm btn-outline-info">
                                                        <span><i class="fa fa-envelope"></i></span>
                                                    </a>
                                                    <a href="#!" class="btn btn-sm btn-outline-info">
                                                        <span><i class="fa fa-comment"></i></span>
                                                    </a>
                                                    <a href="#!" class="btn btn-sm btn-outline-danger">
                                                        <span><i class="fa fa-trash"></i></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#traineesList').DataTable();
    </script>
@endsection
