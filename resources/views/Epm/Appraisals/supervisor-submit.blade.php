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
        .supervisor{
            color: #2AA504;
        }

    </style>
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
                $pmo = \App\Models\User::find($appraisal->pmo_id);
                ?>
                <form id="form-submit-appraisal">
                    <?php
                    $scores=[];
                    foreach ($appraisal->selfScores as $selfScore){
                        $scores[] =$selfScore;
                    }
                    ?>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$pmo->name}}" readonly>
                                <input id="form_appraisal_appraisal_id" type="hidden" name="name"   value="{{$appraisal->id}}">
                                <input id="form_appraisal_pmo_id" type="hidden" name="name"   value="{{$appraisal->pmo_id}}">
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
                                        <tr id="appraisal_report_q1">
                                            <td>1</td>
                                            <td>{!! $appraisal->question_one !!}</td>
                                            <td>
                                                {!! $scores[0]->self_score !!}
                                            </td>
                                            <td>
                                                {!! $scores[0]->self_comment !!}
                                            </td>
                                            <td><input id="supervisor_score_q1" type="text" name="supervisor_score[]" placeholder="" required></td>
                                            <td>
                                                <div id="supervisor_comment_q1"></div>
{{--                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_two)
                                        <tr id="appraisal_report_q2">
                                            <td>2</td>
                                            <td>{!! $appraisal->question_two !!}</td>
                                            <td>
                                                {!! $scores[1]->self_score !!}
                                            </td>
                                            <td>
                                                {!! $scores[1]->self_comment !!}
                                            </td>
                                            <td><input id="supervisor_score_q2" type="text" name="supervisor_score[]" placeholder="" required></td>
                                            <td>
                                                <div id="supervisor_comment_q2"></div>
{{--                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_three)
                                        <tr id="appraisal_report_q3">
                                            <td>3</td>
                                            <td>{!! $appraisal->question_three !!}</td>
                                            <td>
                                                {!! $scores[2]->self_score !!}
                                            </td>
                                            <td>
                                                {!! $scores[2]->self_comment !!}
                                            </td>
                                            <td><input id="supervisor_score_q3" type="text" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="supervisor_comment_q3"></div>
{{--                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_four)
                                        <tr id="appraisal_report_q4">
                                            <td>4</td>
                                            <td>{!! $appraisal->question_four !!}</td>
                                            <td>
                                                {!! $scores[3]->self_score !!}
                                            </td>
                                            <td>
                                                {!! $scores[3]->self_comment !!}
                                            </td>
                                            <td><input id="supervisor_score_q4" type="text" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="supervisor_comment_q4"></div>
{{--                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_five)
                                        <tr id="appraisal_report_q5">
                                            <td>5</td>
                                            <td>{!! $appraisal->question_five !!}</td>
                                            <td>
                                                {!! $scores[4]->self_score !!}
                                            </td>
                                            <td>
                                                {!! $scores[4]->self_comment !!}
                                            </td>
                                            <td><input type="text" id="supervisor_score_q5" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="supervisor_comment_q5"></div>
{{--                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td></td>
                                        <td colspan="5"><h6>Please provide supporting documentation (attachments and/or links) in line with the listed KPIs for your appraisal.</h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><h6>Individual’s overall comments:</h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            {!! $appraisal->pmo_overall_comment !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Initials:</h6></td>
                                        <td colspan="2">
                                            {!! $appraisal->pmo_signature !!}
                                        </td>
                                        <td ><h6>Date</h6></td>
                                        <td colspan="2">
                                            {!! $appraisal->pmo_sign_date !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <h6>Your signature indicates that this Performance Review has been discussed with you and that you are in agreement with the rating awarded.</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><h6>Areas that Need Improvement/ Development (to be filled by Supervisor)</h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div id="improvement_areas"></div>
{{--                                            <textarea name="improvement_areas" cols="100%" rows="5" required></textarea>--}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><h6>Supervisor’s overall comments:</h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div id="supervisor_overall_comment"></div>
{{--                                            <textarea name="supervisor_overall_comment" id="" cols="100%" rows="5" required></textarea>--}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Initials:</h6></td>
                                        <td colspan="2">
                                            <input type="text" id="supervisor_signature" name="supervisor_signature" required>
                                        </td>
                                        <td><h6>Date</h6></td>
                                        <td colspan="2">
                                            <input type="date" id="supervisor_sign_date" name="supervisor_sign_date" value="{{date('Y-m-d')}}" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group float-right mt-2">
                                <button type="submit" class="btn btn-outline-info btn-block mb-3">Submit Report</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var appraisal_report_q1 = $('#appraisal_report_q1');
        if (appraisal_report_q1){
            var quiz1 = new Quill("#supervisor_comment_q1", {
                modules: {
                    toolbar: true
                },
                placeholder: "Your Comment",
                theme: "snow"
            });
        }
        var appraisal_report_q2 = $('#appraisal_report_q2');
        if (appraisal_report_q2){
            var quiz2 = new Quill("#supervisor_comment_q2", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var appraisal_report_q3 = $('#appraisal_report_q3');
        if (appraisal_report_q3){
            var quiz3 = new Quill("#supervisor_comment_q3", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var appraisal_report_q4 = $('#appraisal_report_q4');
        if (appraisal_report_q4){
            var quiz4 = new Quill("#supervisor_comment_q4", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var appraisal_report_q5 = $('#appraisal_report_q5');
        if (appraisal_report_q5){
            var quiz5 = new Quill("#supervisor_comment_q5", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var supervisor_improvement_areas = new Quill("#improvement_areas", {
            modules: {
                toolbar: true
            },
            placeholder: 'Your Comment',
            theme: 'snow'
        });
        var supervisor_overall_comments = new Quill("#supervisor_overall_comment", {
            modules: {
                toolbar: true
            },
            placeholder: 'Your Comment',
            theme: 'snow'
        });
        var formSubmitAppraisal = document.getElementById('form-submit-appraisal');
        formSubmitAppraisal.onsubmit = function(event) {
            // Populate hidden form on submit
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            event.preventDefault();
            // var about = document.querySelector('input[name=about]');
            // window.location = urlHome;
            if (appraisal_report_q1.html()) {
                var comment_q1 =  quiz1.root.innerHTML
                var score_q1 =  $("#supervisor_score_q1").val();
            }
            if (appraisal_report_q2.html()){
                var comment_q2 = quiz2.root.innerHTML;
                var score_q2 =  $("#supervisor_score_q2").val();
            }
            if (appraisal_report_q3.html()) {
                var comment_q3 = quiz3.root.innerHTML;
                var score_q3 =  $("#supervisor_score_q3").val();
            }
            if (appraisal_report_q4.html()) {
                var comment_q4 = quiz4.root.innerHTML;
                var score_q4 =  $("#supervisor_score_q4").val();
            }
            if (appraisal_report_q5.html()) {
                var comment_q5 = quiz5.root.innerHTML;
                var score_q5 =  $("#supervisor_score_q5").val();
            }
            var signature = $("#supervisor_signature").val();
            var sign_date = $("#supervisor_sign_date").val();
            var overall_comment = supervisor_overall_comments.root.innerHTML;
            var improvement_areas = supervisor_improvement_areas.root.innerHTML;
            var user_admin_id = {{auth()->user()->id}};
            var appraisalId = $("#form_appraisal_appraisal_id").val();
            var appraisalPmoId = $("#form_appraisal_pmo_id").val();
            $.ajax({
                url: "/adm/"+user_admin_id+"/save/pmo/performance/appraisal/appraisal_id="+appraisalId+"/"+appraisalPmoId,
                type: 'post',
                data: {
                    supervisor_overall_comment: overall_comment,
                    supervisor_sign_date: sign_date,
                    supervisor_signature: signature,
                    improvement_areas: improvement_areas,
                    supervisor_comment: {
                        quest_one: comment_q1,
                        quest_two: comment_q2,
                        quest_three: comment_q3,
                        quest_four: comment_q4,
                        quest_five: comment_q5,
                    },
                    supervisor_score: {
                        quest_one: score_q1,
                        quest_two: score_q2,
                        quest_three: score_q3,
                        quest_four: score_q4,
                        quest_five: score_q5,
                    },
                },
                success: function(response){
                    window.location = response.redirect_url;
                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        $('form input:not([type="submit"])').keydown(function(e) {
            if (e.keyCode == 13) {
                var inputs = $(this).parents("form").eq(0).find(":input");
                if (inputs[inputs.index(this) + 1] != null) {
                    inputs[inputs.index(this) + 1].focus();
                }
                e.preventDefault();
                return false;
            }
        });
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection







