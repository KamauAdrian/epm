@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
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
                    <table class="table" id="supervisorAppraisals">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Supervisors - Status</th>
                            <th>PMO Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>

                        @if($appraisals_to_supervise)
                            <tbody>
                            @foreach($appraisals_to_supervise as $appraisal_to_supervise)
                                <?php
                                $appraisal = \App\Models\Appraisal::find($appraisal_to_supervise->appraisal_id);
//                                dd($appraisal);
                                ?>
                                <tr>
                                    <td>
                                        {{$appraisal->pmo}}
                                    </td>
                                    <td>
                                        <?php
                                        $supervisors_raw = \App\Models\AppraisalSupervisor::where('appraisal_id',$appraisal->id)->get();
                                        $supervisors = [];
                                        foreach ($supervisors_raw as $supervisor){
                                            $supervisors[]=$supervisor->supervisor;
                                        ?>
                                        @foreach($supervisors as $supervisor)
                                            <?php
                                            $supervisor_status = \App\Models\AppraisalSupervisorReport::where('appraisal_id',$appraisal->id)->where('supervisor_id',$auth_admin->id)->first();
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
                                    <td>
                                        @if($appraisal->pmo_status ==1)
                                            Submitted
                                        @elseif($appraisal->pmo_status ==0)
                                            Pending
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($appraisal->pmo_status ==1 && $supervisor_status==null)
                                            <a href="{{url('/adm/'.$auth_admin->id.'/supervise/pmo/performance/appraisal_id='.$appraisal->id.'/'.$appraisal->pmo_id)}}">
                                                <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Supervise PMO</button>
                                            </a>
                                        @elseif($appraisal->pmo_status ==1 && $supervisor_status)
                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisal/appraisal_id='.$appraisal->id)}}">
                                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info disabled">View Appraisal</button>
                                        </a>
                                        @else
                                            <a href="#!">
                                                <button type="button" class="mr-2 btn btn-dark d-block ml-auto disabled">Supervise PMO</button>
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

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#supervisorAppraisals').DataTable();
    </script>
@endsection
