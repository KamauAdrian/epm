@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 100px; padding-right: 100px">
                <div class="text-center">
                    <h1 class="f-w-400">YEAR 2020 PERFORMANCE APPRAISAL</h1>
                </div>

                <?php
                $auth_admin = auth()->user();
//                dd($pmo);
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
                <form action="{{url('adm/'.$auth_admin->id.'/save/pmo/performance/appraisal/appraisal_id='.$pmo->id.'/'.$pmo->pmo_id)}}" method="post">
                    <?php
//                    dd($pmo->id,$pmo->pmo_id);
                        $appraisal = \App\Models\PmoPerformanceAppraisal::where('appraisal_report_id',$pmo->id)->first();
//                        dd($appraisal);
                    $appraisal_report = \App\Models\PmoPerformanceAppraisal::find($appraisal->id);
                    $report = \App\Models\PmoPerformanceAppraisalReport::where('id',$appraisal->appraisal_report_id)->first();
//                    dd($report);
                    $scores=[];
                    foreach ($appraisal_report->selfScores as $score){
                       $scores[] =$score;
                    }
                    ?>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$pmo->name}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Number</label>
                                <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" value="{{$pmo->employee_number}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="department" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)" value="{{$pmo->department}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="6"><h3>Note: (Refer to KPI’s Document when filling this Appraisal)</h3></th>
                                    </tr>
                                    <tr>
                                        <th>Item</th>
                                        <th>Measure - <br>
                                            Key Performance Indicator</th>
                                        <th>Self Score (%)</th>
                                        <th>Your comment</th>
                                        <th>Supervisor Score (%)</th>
                                        <th>Supervisor  comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($report->question_one)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$report->question_one}}</td>
                                            <td><input type="text" name="self_score[]" placeholder="" value="{{$scores[0]->self_score}}" readonly></td>
                                            <td><input type="text" name="self_comment[]" value="{{$scores[0]->self_comment}}" readonly></td>
                                            <td><input type="text" name="supervisor_score[]" placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($report->question_two)
                                        <tr>
                                            <td>2</td>
                                            <td>{{$report->question_two}}</td>
                                            <td><input type="text" name="self_score[]" placeholder="" value="{{$scores[1]->self_score}}" readonly></td>
                                            <td><input type="text" name="self_comment[]" value="{{$scores[1]->self_comment}}" readonly></td>
                                            <td><input type="text" name="supervisor_score[]" placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($report->question_three)
                                        <tr>
                                            <td>3</td>
                                            <td>{{$report->question_three}}</td>
                                            <td><input type="text" name="self_score[]"  placeholder="" value="{{$scores[2]->self_score}}" readonly></td>
                                            <td><input type="text" name="self_comment[]" value="{{$scores[2]->self_comment}}" readonly></td>
                                            <td><input type="text" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($report->question_four)
                                        <tr>
                                            <td>4</td>
                                            <td>{{$report->question_four}}</td>
                                            <td><input type="text" name="self_score[]"  placeholder="" value="{{$scores[3]->self_score}}" readonly></td>
                                            <td><input type="text" name="self_comment[]" value="{{$scores[3]->self_comment}}" readonly></td>
                                            <td><input type="text" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($report->question_five)
                                    <tr>
                                        <td>5</td>
                                        <td>{{$report->question_five}}</td>
                                        <td><input type="text" name="self_score[]"  placeholder="" value="{{$scores[4]->self_score}}" readonly></td>
                                        <td><input type="text" name="self_comment[]" value="{{$scores[4]->self_comment}}" readonly></td>
                                        <td><input type="text" name="supervisor_score[]"  placeholder="" required></td>
                                        <td>
                                            <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td></td>
                                        <td colspan="5">Please provide supporting documentation (attachments and/or links) in line with the listed KPIs for your appraisal.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Individual’s overall comments:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="self_overall_comment" id="" cols="100%" rows="5" readonly>{{$pmo->self_overall_comment}}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Initials:</td>
                                        <td colspan="2">
                                            <input type="text" name="self_signature" value="{{$pmo->self_signature}}" readonly>
                                        </td>
                                        <td >Date</td>
                                        <td colspan="2">
                                            <input type="date" name="self_sign_date" value="{{$pmo->self_sign_date}}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            Your signature indicates that this Performance Review has been discussed with you and that you are in agreement with the rating awarded.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Areas that Need Improvement/ Development (to be filled by Supervisor)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="improvement_areas" cols="100%" rows="5" required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Supervisor’s overall comments:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="supervisor_overall_comment" id="" cols="100%" rows="5" required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Initials:</td>
                                        <td colspan="2">
                                            <input type="text" name="supervisor_signature" required>
                                        </td>
                                        <td >Date</td>
                                        <td colspan="2">
                                            <input type="date" name="supervisor_sign_date" value="{{date('Y-m-d')}}" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        var i = 0;
        $(document).on("click", "#addActivity", function(){
            i++
            console.log(i);
            var activity = $('.addNewActivity');
            console.log(activity);
            activity.last().after('<tr class="addNewActivity">'+activity.first().html()+'</tr>');
        });

        $(document).on("click", "#addNewQuestion", function(){
            var question = $('.addReportQuestion');
            question.last().after('<div class="col-sm-12 addReportQuestion">'+question.first().html()+'</div><br />');
        });
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection







