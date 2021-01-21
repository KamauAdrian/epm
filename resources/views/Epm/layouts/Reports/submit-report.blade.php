<?php
$auth_admin = auth()->user();
?>
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
<form action="{{url('/adm/'.$auth_admin->id.'/save/report/'.$report->id)}}" method="post">
    @csrf
    <div class="row">
        <?php
        if ($report->fields){
            $names = \Illuminate\Support\Facades\DB::table('report_template_fields')->where('report_template_id',$report->id)->pluck('name');
            $field_names = [];
            foreach ($names as $name){
                $field_names[] = $name;
            }
        }
        ?>
        @if($report->fields)
            @if(in_array('Name',$field_names))
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Reported By Name</label>
                        <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$auth_admin->name}}" required>
                        <input type="hidden" name="report_template_id" class="form-control" value="{{$report->id}}">
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>
                </div>
            @endif
            @if(in_array('Employee Number',$field_names))
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Employee Number</label>
                        <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" value="{{$auth_admin->employee_number}}" required>
                        <span class="text-danger">{{$errors->first('employee_number')}}</span>
                    </div>
                </div>
            @endif
            @if(in_array('Date of Report',$field_names))
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date of Report</label>
                        <input type="date" name="date_of_report" style="border: none; border-bottom: 1px solid #000000;" class="form-control" required>
                        <span class="text-danger">{{$errors->first('date_of_report')}}</span>
                    </div>
                </div>
            @endif
            @if(in_array('Role',$field_names))
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Team Lead" required>
                        <span class="text-danger">{{$errors->first('role')}}</span>
                    </div>
                </div>
            @endif
            @if(in_array('Duty Station',$field_names))
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Duty Station</label>
                        <input type="text" name="duty_station" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)" value="{{old('duty_station')}}" required>
                        {{--                @if($auth_admin->center_id)--}}
                        {{--                    <input type="text" name="duty_station" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Limuru" value="{{$auth_admin->center->name}}">--}}
                        {{--                @else--}}
                        {{--                    <input type="text" name="duty_station" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Limuru" value="{{old('duty_station')}}">--}}
                        {{--                @endif--}}
                        <span class="text-danger">{{$errors->first('duty_station')}}</span>
                    </div>
                </div>
            @endif
        @endif
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    @if($report->questions)
                        <?php
                        $report_questions = \Illuminate\Support\Facades\DB::table('report_questions')->where('report_template_id',$report->id)->get();
                        $questions = [];
                        foreach ($report_questions as $report_question){
                            $questions[]= $report_question;
                        }
                        ?>
                        <thead>
                            <tr>
                                <th>
                                    Activities
                                </th>
                                @foreach($questions as $question)
                                    <th>
                                        {{$question->question}}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="addNewActivity" length="{{count($questions)}}">
                            <td>
                                <input type="text" name="activity[]" style="border: none;" placeholder="eg Training" required>
                            </td>
                            @foreach($questions as $question)
                                <td>
                                    <input type="text" name="reports_{{$question->id}}_quest[]" style="border: none;" required>
                                    {{--                                        <input type="text" name="question{{$question->id}}[]" style="border: none;" required>--}}
                                </td>
                            @endforeach
                        </tr>
{{--                            <tr id="addNewActivity" length="{{count($questions)}}">--}}
{{--                                <td>--}}
{{--                                    <input type="text" name="activity[]" style="border: none;" placeholder="eg Training" required>--}}
{{--                                </td>--}}
{{--                                @foreach($questions as $question)--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="reports_{{$question->id}}_quest[]" style="border: none;" required>--}}
{{--                                        <input type="text" name="question{{$question->id}}[]" style="border: none;" required>--}}
{{--                                    </td>--}}
{{--                                @endforeach--}}
{{--                            </tr>--}}
                        </tbody>
                    @endif
                </table>
                    <div class="form-group">
                        <a href="#!" style="color: #7E858E;" id="addActivity"><span><i class="fa fa-plus"></i></span> Add Another Activity</a>
                    </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right mt-2">
{{--                <button type="button" class="btn btn-outline-primary btn-block mb-3">Submit Report</button>--}}
                <button type="submit" class="btn btn-outline-primary btn-block mb-3">Submit Report</button>
            </div>
        </div>

    </div>
</form>
