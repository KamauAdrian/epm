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
                ?>
                <form action="#!" method="">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S"  readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Number</label>
                                <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198"  readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="department" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)"  readonly>
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
                                    @if($template->question_one)
                                        <tr>
                                            <td>1</td>
                                            <td>{!!  $template->question_one !!}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @if($template->question_two)
                                        <tr>
                                            <td>2</td>
                                            <td>{!! $template->question_two !!}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @if($template->question_three)
                                        <tr>
                                            <td>3</td>
                                            <td>{!! $template->question_three !!}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @if($template->question_four)
                                        <tr>
                                            <td>4</td>
                                            <td>{!! $template->question_four !!}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @if($template->question_five)
                                        <tr>
                                            <td>5</td>
                                            <td>{!! $template->question_five !!}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr>
                                        <td>Initials:</td>
                                        <td colspan="2"></td>
                                        <td >Date</td>
                                        <td colspan="2"></td>
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
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Supervisor’s overall comments:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr>
                                        <td>Initials:</td>
                                        <td colspan="2"></td>
                                        <td><h6>Date</h6></td>
                                        <td colspan="2"></td>
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
        // $(document).ready(function(){
        //     $('.table-responsive').doubleScroll();
        // });
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







