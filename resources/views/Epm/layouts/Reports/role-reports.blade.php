<?php
$auth_admin = auth()->user();
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center mb-4">
            <h1 class="d-inline-block mb-0 font-weight-normal">{{$report_target_group->name}} Reports</h1>
            {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        </div>
        @if($templates)
            @foreach($templates as $template)
                <?php
                    $reports = \Illuminate\Support\Facades\DB::table('reports')->where('report_template_id',$template->id)->where('report_target_group_id',$report_target_group->id)->get();
//                    $format_date = date('l dS M Y',strtotime($report_date));
                ?>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>{{$template->name}} Total reports {{count($reports)}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-md-6">
{{--                                    <a href="#!">--}}
                                    <a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/report_target_group_id='.$report_target_group->id)}}">
                                        <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Reports</p></button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!">
                                        <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Reports</p></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="card">
{{--                    <div class="card-header">--}}
{{--                        <h6>{{$template->name}} Total reports {{count($reports)}}</h6>--}}
{{--                    </div>--}}
                    <div class="card-body">
                        <p>No Reports From {{$report_target_group->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
        @endif
    </div>
</div>
