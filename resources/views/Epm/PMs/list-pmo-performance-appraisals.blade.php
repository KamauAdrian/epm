@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php use App\Models\PmoPerformanceAppraisal;use App\Models\PmoPerformanceAppraisalReport;$auth_admin = auth()->user();
    $appraisal_fill = \App\Models\PmoPerformanceAppraisalReport::where('pmo_id',$auth_admin->id)->first();
    ?>
    {{--    @include('Epm.layouts.Reports.templates')--}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Performance Appraisals To Supervise</h1>
                {{--                    <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
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
                    <table class="table" id="reportTemplates">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Supervisor</th>
                            <th>PMO Status</th>
                            <th>Supervisor Status</th>
                            <th class="text-right">Action</th>
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
                                        <?php $s_name = \App\Models\User::find($appraisal->supervisor_id);  ?>
                                        {{$appraisal->supervisor}}
                                    </td>
                                    <?php
                                    $report = PmoPerformanceAppraisal::where('pmo_id',$appraisal->pmo_id)->first();
                                    $pmo_status = $report->pmo_status;
                                    $supervisor_status = $report->supervisor_status;
                                    ?>
                                    <td>
                                        @if($pmo_status ==1)
                                            Submitted
                                        @elseif($pmo_status==0)
                                            Pending
                                        @endif
                                    </td>
                                    <td>
                                        @if($supervisor_status ==1)
                                            Submitted
                                        @elseif($supervisor_status==0)
                                            Pending
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <?php
                                        $appraisal_supervise = \App\Models\PmoPerformanceAppraisalReport::where('id',$appraisal->id)->first();
//                                        dd($appraisal_supervise);
                                        if ($appraisal_supervise){
                                            $pmo = PmoPerformanceAppraisal::where('pmo_id',$appraisal_supervise->pmo_id)->first();
                                        }

                                        ?>
                                        @if($pmo_status ==1 && $supervisor_status==0)
                                            <a href="{{url('/adm/'.$auth_admin->id.'/supervise/pmo/performance/id='.$appraisal_supervise->id.'/pmo='.$appraisal_supervise->pmo_id)}}">
                                                <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Supervise PMO</button>
                                            </a>
                                        @elseif($pmo_status ==1 && $supervisor_status==1)
                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisal/appraisal_id='.$report->id)}}">
                                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info disabled">View Appraisal</button>
                                        </a>
                                        @else
                                            <a href="#!">
                                                <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info disabled">Supervise PMO</button>
                                            </a>
                                        @endif
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
