@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <style>
        .table-responsive {
            max-width: 100%;
            max-height: 100vh;
            overflow: auto !important;
        }
        .table-responsive .table {
            min-width: 600px;
        }
        /*.formFixedTop{*/
        /*    position: sticky;*/
        /*    top: 0;*/
        /*}*/
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 100px; padding-right: 100px">
                <?php
                $auth_admin = auth()->user();
                $supervisor = \App\Models\AppraisalSupervisor::where('appraisal_id',$appraisal->id)->first();
                $self_scores = [];
                $supervisor_scores = [];
                foreach ($appraisal->selfScores as $score_raw_self){
                    $self_scores[] = $score_raw_self;
                }
                foreach ($appraisal->supervisorScores as $score_raw_supervisor){
                    $supervisor_scores[] = $score_raw_supervisor;
                }
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
                        <div class="col-md-12 formFixedTop">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <h1 class="f-w-400">YEAR 2020 PERFORMANCE APPRAISAL</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$appraisal->pmo}}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$appraisal->pmo_title}}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee Number</label>
                                        <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" value="{{$appraisal->pmo_employee_number}}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" name="departmment" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)" value="{{$appraisal->pmo_department}}" readonly>
                                    </div>
                                </div>
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
                                        <th><h6>Item</h6></th>
                                        <th><h6>Measure - <br>
                                                Key Performance Indicator</h6></th>
                                        <th><h6>Self Score (%)</h6></th>
                                        <th><h6>Your comment</h6></th>
                                        <th><h6>Supervisor Score (%)</h6></th>
                                        <th><h6>Supervisor  comment</h6></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($appraisal->question_one)
                                        <tr>
                                            <td>1</td>
                                            <td>{!! nl2br(e($appraisal->question_one)) !!}</td>
                                            <td>
                                                {!! $self_scores[0]->self_score !!}
                                            </td>
                                            <td>
                                                {!! nl2br(e($self_scores[0]->self_comment)) !!}
                                            </td>
                                            @if($supervisor_scores)
                                                <td>
                                                    {!! $supervisor_scores[0]->supervisor_score !!}
                                                </td>
                                                <td>
                                                    {!! nl2br(e($supervisor_scores[0]->supervisor_comment)) !!}
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($appraisal->question_two)
                                        <tr>
                                            <td>2</td>
                                            <td>{!! nl2br(e($appraisal->question_two)) !!}</td>
                                            <td>
                                                {!! $self_scores[1]->self_score !!}
                                            </td>
                                            <td>
                                                {!! nl2br(e($self_scores[1]->self_comment)) !!}
                                            </td>
                                            @if($supervisor_scores)
                                                <td>
                                                    {!! $supervisor_scores[1]->supervisor_score !!}
                                                </td>
                                                <td>
                                                    {!! nl2br(e($supervisor_scores[1]->supervisor_comment)) !!}
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($appraisal->question_three)
                                        <tr>
                                            <td>3</td>
                                            <td>{!! nl2br(e($appraisal->question_three)) !!}</td>
                                            <td>
                                                {!! $self_scores[2]->self_score !!}
                                            </td>
                                            <td>
                                                {!! nl2br(e($self_scores[2]->self_comment)) !!}
                                            </td>
                                            @if($supervisor_scores)
                                                <td>
                                                    {!! $supervisor_scores[2]->supervisor_score !!}
                                                </td>
                                                <td>
                                                    {!! nl2br(e($supervisor_scores[2]->supervisor_comment)) !!}
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($appraisal->question_four)
                                        <tr>
                                            <td>4</td>
                                            <td>{!! nl2br(e($appraisal->question_four)) !!}</td>
                                            <td>
                                                {!! $self_scores[3]->self_score !!}
                                            </td>
                                            <td>
                                                {!! nl2br(e($self_scores[3]->self_comment)) !!}
                                            </td>
                                            @if($supervisor_scores)
                                                <td>
                                                    {!! $supervisor_scores[3]->supervisor_score !!}
                                                </td>
                                                <td>
                                                    {!! nl2br(e($supervisor_scores[3]->supervisor_comment)) !!}
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if($appraisal->question_five)
                                        <tr>
                                            <td>5</td>
                                            <td>{!! nl2br(e($appraisal->question_five)) !!}</td>
                                            <td>
                                                {!! $self_scores[4]->self_score !!}
                                            </td>
                                            <td>
                                                {!! nl2br(e($self_scores[4]->self_comment)) !!}
                                            </td>
                                            @if($supervisor_scores)
                                                <td>
                                                    {!! $supervisor_scores[4]->supervisor_score !!}
                                                </td>
                                                <td>
                                                    {!! nl2br(e($supervisor_scores[4]->supervisor_comment)) !!}
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endif
                                    <tr>
                                        <td></td>
                                        <td colspan="5">
                                            <h6>
                                                Please provide supporting documentation (attachments and/or links) in line with the listed KPIs for your appraisal.
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h6>
                                                Individual’s overall comments:
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">{!! nl2br(e($appraisal->pmo_overall_comment)) !!}</td>
                                    </tr>
                                    <tr>
                                        <td><h6>Signature:</h6></td>
                                        <td colspan="2">{!! $appraisal->pmo_signature !!}</td>
                                        <td><h6>Date</h6></td>
                                        <td colspan="2">
                                            {!! $appraisal->pmo_sign_date !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h6>
                                                Your signature indicates that this Performance Review has been discussed with you and that you are in agreement with the rating awarded.
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h6>
                                                Areas that Need Improvement/ Development (to be filled by Supervisor)
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if($supervisor->improvement_areas)
                                            <td colspan="6">
                                                {!! nl2br(e($supervisor->improvement_areas)) !!}
                                            </td>
                                        @else
                                            <td colspan="6"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h6>
                                                Supervisor’s overall comments:
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if($supervisor->supervisor_overall_comment)
                                            <td colspan="6">
                                                {!! nl2br(e($supervisor->supervisor_overall_comment)) !!}
                                            </td>
                                        @else
                                            <td colspan="6"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td><h6>Signature:</h6></td>
                                        @if($supervisor->supervisor_signature)
                                            <td colspan="2">
                                                {!! $supervisor->supervisor_signature !!}
                                            </td>
                                        @else
                                            <td colspan="2"></td>
                                        @endif
                                        <td><h6>Date</h6></td>
                                        @if($supervisor->supervisor_sign_date)
                                            <td colspan="2">
                                                {!! $supervisor->supervisor_sign_date !!}
                                            </td>
                                        @else
                                            <td colspan="2"></td>
                                        @endif
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







