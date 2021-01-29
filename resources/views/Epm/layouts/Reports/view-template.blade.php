<?php
$auth_admin = auth()->user();
$reporting_groups = [];
$groups = $template->groups;
foreach ($groups as $group){
    $reporting_groups[] = $group->name;
}
$reporting_groups_string = implode(', ',$reporting_groups);
?>
<div class="col-sm-12">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template')}}">Templates</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/report/template/'.$template->id)}}">{{$template->name}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center mb-4">
            <h1 class="d-inline-block mb-0 font-weight-normal">{{$template->name}}
                ({{$reporting_groups_string}})
            </h1>
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
                    @if($template->fields)
                            @if(in_array('Name',$field_names))
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Reported By Name</label>
                                        <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" disabled>
                                    </div>
                                </div>
                            @endif
                            @if(in_array('Employee Number',$field_names))
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee Number</label>
                                        <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" disabled>
                                    </div>
                                </div>
                            @endif
                            @if(in_array('Date of Report',$field_names))
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Report</label>
                                        <input type="date" name="date" style="border: none; border-bottom: 1px solid #000000;" class="form-control" disabled>
                                    </div>
                                </div>
                            @endif
                            @if(in_array('Role',$field_names))
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <input type="text" name="role" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Team Lead" disabled>
                                    </div>
                                </div>
                            @endif
                            @if(in_array('Duty Station',$field_names))
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Duty Station</label>
                                        <input type="text" name="duty_station" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Limuru" disabled>
                                    </div>
                                </div>
                            @endif
                    @endif

                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @if($template->questions)
                                    <?php
                                    $report_questions = \Illuminate\Support\Facades\DB::table('report_questions')->where('report_template_id',$template->id)->get();
                                    $questions = [];
                                    foreach ($report_questions as $report_question){
                                        $questions[]= $report_question;
                                    }
//                                    dd($questions);
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
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" style="border: none;" disabled>
                                        </td>
                                        @foreach($questions as $question)
                                            <td>
                                                <input type="{{$question->question_type}}" class="form-control" style="border: none;" disabled>
                                            </td>
                                        @endforeach
                                    </tr>
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


