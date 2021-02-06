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
                $self_scores = [];
                $supervisor_scores = [];
                $report = \App\Models\PmoPerformanceAppraisalReport::where('id',$appraisal->appraisal_report_id)->first();
//                dd($appraisal);
                foreach ($appraisal->selfScores as $score_raw_self){
                    $self_scores[] = $score_raw_self;
                }
//                dd($self_scores);
                foreach ($appraisal->supervisorScores as $score_raw_supervisor){
                    $supervisor_scores[] = $score_raw_supervisor;
                }
//                dd($supervisor_scores);
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
                <form action="#!" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$appraisal->name}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$appraisal->title}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Number</label>
                                <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" value="{{$appraisal->employee_number}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="departmment" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)" value="{{$appraisal->department}}" readonly>
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
                                            <td><input type="text" name="self_score[]" value="{{$self_scores[0]->self_score}}" readonly></td>
                                            <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                {{$self_scores[0]->self_comment}}
                                            </textarea>
                                            </td>
                                            @if($supervisor_scores)
                                                <td><input type="text" name="supervisor_score[]"  value="{{$supervisor_scores[0]->supervisor_score}}" readonly></td>
                                                <td>
                                                <textarea name="" id="" cols="30" rows="5" readonly>
                                                    {{$supervisor_scores[0]->supervisor_comment}}
                                                </textarea>
                                                </td>
                                            @else
                                                <td><input type="text" name="supervisor_score[]" readonly></td>
                                                <td><textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly></textarea></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($report->question_two)
                                        <tr>
                                            <td>2</td>
                                            <td>{{$report->question_two}}</td>
                                            <td><input type="text" name="self_score[]"  value="{{$self_scores[1]->self_score}}" readonly></td>
                                            <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                {{$self_scores[1]->self_comment}}
                                            </textarea>
                                            </td>
                                            @if($supervisor_scores)
                                                <td><input type="text" name="supervisor_score[]"  value="{{$supervisor_scores[1]->supervisor_score}}" readonly></td>
                                                <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                    {{$supervisor_scores[1]->supervisor_comment}}
                                                </textarea>
                                                </td>
                                            @else
                                                <td><input type="text" name="supervisor_score[]" readonly></td>
                                                <td><textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly></textarea></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($report->question_three)
                                        <tr>
                                            <td>3</td>
                                            <td>{{$report->question_three}}</td>
                                            <td><input type="text" name="self_score[]" value="{{$self_scores[2]->self_score}}" readonly></td>
                                            <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                {{$self_scores[2]->self_comment}}
                                            </textarea>>
                                            </td>
                                            @if($supervisor_scores)
                                                <td><input type="text" name="supervisor_score[]" value="{{$supervisor_scores[2]->supervisor_score}}" readonly></td>
                                                <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                    {{$supervisor_scores[2]->supervisor_comment}}
                                            </textarea>
                                                </td>
                                            @else
                                                <td><input type="text" name="supervisor_score[]" readonly></td>
                                                <td><textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly></textarea></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($report->question_four)
                                        <tr>
                                            <td>4</td>
                                            <td>{{$report->question_four}}</td>
                                            <td><input type="text" name="self_score[]" value="{{$self_scores[3]->self_score}}" readonly></td>
                                            <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                {{$self_scores[3]->self_comment}}
                                            </textarea>
                                            </td>
                                            @if($supervisor_scores)
                                                <td><input type="text" name="supervisor_score[]" value="{{$supervisor_scores[3]->supervisor_score}}" readonly></td>
                                                <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                    {{$supervisor_scores[3]->supervisor_comment}}
                                            </textarea>
                                                </td>
                                            @else
                                                <td><input type="text" name="supervisor_score[]" readonly></td>
                                                <td><textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly></textarea></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($report->question_five)
                                        <tr>
                                            <td>5</td>
                                            <td>{{$report->question_five}}</td>
                                            <td><input type="text" name="self_score[]" value="{{$self_scores[4]->self_score}}" readonly></td>
                                            <td>
                                        <textarea name="" id="" cols="30" rows="5" readonly>
                                                {{$self_scores[4]->self_comment}}
                                            </textarea>
                                            </td>
                                            @if($supervisor_scores)
                                                <td><input type="text" name="supervisor_score[]" value="{{$supervisor_scores[4]->supervisor_score}}" readonly></td>
                                                <td>
                                            <textarea name="" id="" cols="30" rows="5" readonly>
                                                    {{$supervisor_scores[4]->supervisor_comment}}
                                            </textarea>
                                                </td>
                                            @else
                                                <td><input type="text" name="supervisor_score[]" readonly></td>
                                                <td>
                                                    <textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly></textarea>
                                                </td>
                                            @endif
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
                                            <textarea name="" id="" cols="100%" rows="3" readonly>
                                                {{$appraisal->self_overall_comment}}
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Signature:</td>
                                        <td colspan="2">
                                                    <input type="text" name="" value="{{$appraisal->self_signature}}" readonly>
                                        </td>
                                        <td >Date</td>
                                        <td colspan="2">
                                            <input type="date" name="self_sign_date" value="{{$appraisal->self_sign_date}}" style="border: none;" readonly>
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
                                            <textarea name="" id="" cols="100%" rows="5" readonly>
                                                {{$appraisal->improvement_areas}}
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Supervisor’s overall comments:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="" id="" cols="100%" rows="5" readonly>
                                                {{$appraisal->supervisor_overall_comment}}
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Signature:</td>
                                        <td colspan="2">
                                                <input type="text" name="" value="{{$appraisal->supervisor_signature}}" readonly>
                                        </td>
                                        <td >Date</td>
                                        <td colspan="2">
                                            <input type="date" name="supervisor_sign_date" value="{{$appraisal->supervisor_sign_date}}" style="border: none;" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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







