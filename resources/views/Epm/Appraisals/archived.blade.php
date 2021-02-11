@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    {{--    @include('Epm.layouts.Reports.templates')--}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Archived Performance Appraisals</h1>
                {{--                    <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
{{--                <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">--}}
{{--                    <a href="{{url('/adm/'.$auth_admin->id.'/create/new/performance/appraisal')}}">--}}
{{--                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Create Appraisal</button>--}}
{{--                    </a>--}}
{{--                    --}}
{{--                </div>--}}

        </div>
        <div class="row">
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
                <div class="table-responsive">
                    <table class="table" id="appraisalsTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Supervisors - Status</th>
                            <th>PMO Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>

                        @if($appraisals)
                            <tbody>
                            @foreach($appraisals as $appraisal)
                                <tr>
                                    <td>
                                        {{$appraisal->pmo}}
                                    </td>
                                    <td>
                                        <?php
                                        $supervisors_raw = \App\Models\AppraisalSupervisor::where('appraisal_id',$appraisal->id)->get();
                                        //                                        dd($supervisors_raw);
                                        $supervisors = [];
                                        foreach ($supervisors_raw as $supervisor){
                                            $supervisors[]=$supervisor->supervisor;
                                        }
                                        //                                        $names = implode(',',$supervisors);
                                        ?>
                                        @foreach($supervisors as $supervisor)
                                            <?php
                                            $supervisor_status = \App\Models\AppraisalSupervisorReport::where('appraisal_id',$appraisal->id)->first();
                                            ?>
                                            @if($supervisor_status)
                                                <p class="mb-3">
                                                    {{$supervisor}} - Submitted <br />
                                                </p>
                                            @else
                                                <p class="mb-3">
                                                    {{$supervisor}} - Pending <br />
                                                </p>
                                            @endif
                                        @endforeach
                                    </td>
                                    <?php
                                    $pmo_status = $appraisal->pmo_status;
                                    ?>
                                    <td>
                                        @if($pmo_status ==1)
                                            Submitted
                                        @elseif($pmo_status==0)
                                            Pending
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="badge badge-pill badge-light-dark">Archived</span>
                                                <span class = "caret"></span>
                                            </button>
                                            <ul class = "dropdown-menu" role = "menu">
                                                <li>
                                                    @if($pmo_status ==1)
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisal/appraisal_id='.$appraisal->id)}}">
                                                            View Appraisal
                                                        </a>
                                                    @else
                                                        @if($auth_admin->role->name == 'Project Manager')
                                                            <a href="{{url('/adm/'.$auth_admin->id.'/submit/performance/appraisal/appraisal_id='.$appraisal->id)}}">
                                                                Submit Appraisal
                                                            </a>
                                                        @else
                                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisal/template/appraisal_id='.$appraisal->id)}}">
                                                                View Appraisal
                                                            </a>
                                                        @endif
                                                    @endif
                                                </li>
                                                @if($appraisal->status==0)
                                                    <li>
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/archive/performance/appraisals/'.$appraisal->id)}}">
                                                            Archive Appraisal
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
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
@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#appraisalsTable').DataTable();
    </script>
@endsection
