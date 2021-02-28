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
                //                dd($appraisal);
                ?>
                {{--                <form action="{{url('/adm/'.$auth_admin->id.'/save/report/'.$report->id)}}" method="post">--}}
                <form id="form-submit-appraisal">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$auth_admin->name}}" required>
                                <input type="hidden" id="form_appraisal_id"   value="{{$appraisal->id}}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="pmo-title" name="title" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{old('title')}}" required>
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Number</label>
                                <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" value="{{$auth_admin->employee_number}}" required>
                                <span class="text-danger">{{$errors->first('employee_number')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="departmment" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)" value="{{$auth_admin->department}}" required>
                                <span class="text-danger">{{$errors->first('duty_station')}}</span>
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
                                        <th></th>
                                        <th>Measure - <br>
                                            Key Performance Indicator</th>
                                        <th>Self Score (%)</th>
                                        <th>Your comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($appraisal->question_one)
                                        <tr id="appraisal_report_q1">
                                            <td>1</td>
                                            <td>{!! $appraisal->question_one !!}</td>
                                            <td><input type="text" id="self_score_q1" name="self_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="self_comment_q1" style="width: 100%">

                                                </div>
{{--                                                <textarea name="self_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_two)
                                        <tr id="appraisal_report_q2">
                                            <td>2</td>
                                            <td>{!! $appraisal->question_two !!}</td>
                                            <td><input id="self_score_q2" type="text" name="self_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="self_comment_q2" style="width: 100%">

                                                </div>
{{--                                                <textarea name="self_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_three)
                                        <tr id="appraisal_report_q3">
                                            <td>3</td>
                                            <td>{!! $appraisal->question_three !!}</td>
                                            <td><input id="self_score_q3" type="text" name="self_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="self_comment_q3" style="width: 100%">

                                                </div>
{{--                                                <textarea name="self_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_four)
                                        <tr id="appraisal_report_q4">
                                            <td>4</td>
                                            <td>{!! $appraisal->question_four !!}</td>
                                            <td><input id="self_score_q4" type="text" name="self_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="self_comment_q4" style="width: 100%">

                                                </div>
{{--                                                <textarea name="self_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_five)
                                        <tr id="appraisal_report_q5">
                                            <td>5</td>
                                            <td>{!! $appraisal->question_five !!}</td>
                                            <td><input id="self_score_q5" type="text" name="self_score[]"  placeholder="" required></td>
                                            <td>
                                                <div id="self_comment_q5" style="width: 100%">

                                                </div>
{{--                                                <textarea name="self_comment[]" id="" cols="30" rows="5" required></textarea>--}}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4">Please provide supporting documentation (attachments and/or links) in line with the listed KPIs for your appraisal.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Individual’s overall comments:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div id="self_overall_comment" style="width: 100%">

                                            </div>
{{--                                            <textarea name="self_overall_comment" id="" cols="100%" rows="5" required></textarea>--}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Initials:</td>
                                        <td>
                                            <input type="text" id="pmo_self_signature" name="self_signature" required>
                                        </td>
                                        <td >Date</td>
                                        <td>
                                            <input type="date" id="pmo_self_sign_date" name="self_sign_date" value="{{date('Y-m-d')}}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Your signature indicates that this Performance Review has been discussed with you and that you are in agreement with the rating awarded.
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
        // var appraisalTemplate = $('#appraisal_template');
        var appraisal_report_q1 = $('#appraisal_report_q1');
        if (appraisal_report_q1){
            var quiz1 = new Quill("#self_comment_q1", {
                modules: {
                    toolbar: true
                },
                placeholder: "Your Comment",
                theme: "snow"
            });
        }
        var appraisal_report_q2 = $('#appraisal_report_q2');
        if (appraisal_report_q2){
            var quiz2 = new Quill("#self_comment_q2", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var appraisal_report_q3 = $('#appraisal_report_q3');
        if (appraisal_report_q3){
            var quiz3 = new Quill("#self_comment_q3", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var appraisal_report_q4 = $('#appraisal_report_q4');
        if (appraisal_report_q4){
            var quiz4 = new Quill("#self_comment_q4", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var appraisal_report_q5 = $('#appraisal_report_q5');
        if (appraisal_report_q5){
            var quiz5 = new Quill("#self_comment_q5", {
                modules: {
                    toolbar: true
                },
                placeholder: 'Your Comment',
                theme: 'snow'
            });
        }
        var self_overall_comments = new Quill("#self_overall_comment", {
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
                var score_q1 =  $("#self_score_q1").val();
            }
            if (appraisal_report_q2.html()){
                var comment_q2 = quiz2.root.innerHTML;
                var score_q2 =  $("#self_score_q2").val();
            }
            if (appraisal_report_q3.html()) {
                var comment_q3 = quiz3.root.innerHTML;
                var score_q3 =  $("#self_score_q3").val();
            }
            if (appraisal_report_q4.html()) {
                var comment_q4 = quiz4.root.innerHTML;
                var score_q4 =  $("#self_score_q4").val();
            }
            if (appraisal_report_q5.html()) {
                var comment_q5 = quiz5.root.innerHTML;
                var score_q5 =  $("#self_score_q5").val();
            }
            var title = $("#pmo-title").val();
            var self_signature = $("#pmo_self_signature").val();
            var self_sign_date = $("#pmo_self_sign_date").val();
            var overall_comment = self_overall_comments.root.innerHTML;
            var user_admin_id = {{auth()->user()->id}};
            var appraisalId = $("#form_appraisal_id").val();
            // var formData = $("#form-submit-appraisal").serializeArray();
            $.ajax({
                url: '/adm/'+user_admin_id+'/save/my/performance/appraisal/appraisal_id='+appraisalId,
                type: 'post',
                data: {
                    title: title,
                    self_overall_comment: overall_comment,
                    self_sign_date: self_sign_date,
                    self_signature: self_signature,
                    self_comment: {
                        quest_one: comment_q1,
                        quest_two: comment_q2,
                        quest_three: comment_q3,
                        quest_four: comment_q4,
                        quest_five: comment_q5,
                    },
                    self_score: {
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







