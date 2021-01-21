<?php
$auth_admin = auth()->user();
?>
<div class="col-sm-12">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id)}}">Reports</a></li>
{{--                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/report/template/'.$template->id)}}">{{$template->name}}</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center mb-4">
            <h1 class="d-inline-block mb-0 font-weight-normal">{{$template->name}}</h1>
            {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
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

            <form action="#!" method="post">
                @csrf
                <div class="row">
                    <?php
                    if ($template->fields){
                        $names = \Illuminate\Support\Facades\DB::table('report_template_fields')->where('report_template_id',$template->id)->pluck('name');
                        $field_names = [];
                        foreach ($names as $name){
                            $field_names[] = $name;
                        }
//                        dd($field_names);
                    }
                    ?>

                        @if($report->name)
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Reported By Name</label>
                                    <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" value="{{$report->name}}" disabled>
                                </div>
                            </div>
                        @endif
                        @if($report->employee_number)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee Number</label>
                                    <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" value="{{$report->employee_number}}" disabled>
                                </div>
                            </div>
                        @endif
                        @if($report->date_of_report)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Report</label>
                                    <input type="date" name="date" style="border: none; border-bottom: 1px solid #000000;" class="form-control" value="{{$report->date_of_report}}" disabled>
                                </div>
                            </div>
                        @endif
                        @if($report->role)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" name="role" style="border: none; border-bottom: 1px solid #000000;" class="form-control" value="{{$report->role}}" disabled>
                                </div>
                            </div>
                        @endif
                        @if($report->duty_station)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Duty Station</label>
                                    <input type="text" name="duty_station" style="border: none; border-bottom: 1px solid #000000;" class="form-control" value="{{$report->duty_station}}" disabled>
                                </div>
                            </div>
                        @endif


                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @if($template->questions)
                                    <?php
                                    $report_questions = \Illuminate\Support\Facades\DB::table('report_questions')->where('report_template_id',$template->id)->get();
                                    $report_activities = \Illuminate\Support\Facades\DB::table('report_activities')->where('report_id',$report->id)->get();
                                    $questions = [];
                                    $activities = [];
                                    foreach ($report_questions as $report_question){
                                        $questions[]= $report_question;
                                    }
                                    foreach ($report_activities as $report_activity){
                                        $activities[]= $report_activity;
                                    }
//                                    foreach ($report_reports as $report_report){
//                                        $reports[]= $report_report;
//                                    }
//                                    dd($report_activities,$activities,$questions);
                                    ?>
                                    <thead>
                                    <tr>
                                        <th>
                                            Activities
                                        </th>
                                        @foreach($questions as $question)
                                            <th>{{$question->question}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td>
                                                <input type="text"  value="{{$activity->name}}" style="border: none;" disabled>
                                            </td>


                                            <?php
//                                            dd($questions);
                                            $reports = [];
                                            $report_reports = \Illuminate\Support\Facades\DB::table('report_reports')->where('report_id',$report->id)->where('activity_id',$activity->id)->get();
                                            foreach ($report_reports as $report_report){
                                                $reports[] = $report_report->report;
                                            }
//                                            dd($reports);
                                            ?>
                                            @foreach($questions as $key=>$question)
                                                <td>
                                                    <input type="text" style="border: none;" value="{{$reports[$key]}}" disabled>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


