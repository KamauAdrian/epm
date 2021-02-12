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
                <form action="{{url('adm/'.$auth_admin->id.'/save/pmo/performance/appraisal/appraisal_id='.$appraisal->id.'/'.$appraisal->pmo_id)}}" method="post">
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
                                <input type="text" name="department" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="(County, Constituency)" value="{{$appraisal->pmo_department}}" readonly>
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
                                    @if($appraisal->question_one)
                                        <tr>
                                            <td>1</td>
                                            <td>{!! nl2br(e($appraisal->question_one)) !!}</td>
                                            <td><input type="text" name="self_score[]" placeholder="" value="{{$scores[0]->self_score}}" readonly></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly>{{$scores[0]->self_comment}}</textarea>
                                            </td>
                                            <td><input type="text" name="supervisor_score[]" placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_two)
                                        <tr>
                                            <td>2</td>
                                            <td>{!! nl2br(e($appraisal->question_two)) !!}</td>
                                            <td><input type="text" name="self_score[]" placeholder="" value="{{$scores[1]->self_score}}" readonly></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly>{{$scores[1]->self_comment}}</textarea>
                                            </td>
                                            <td><input type="text" name="supervisor_score[]" placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_three)
                                        <tr>
                                            <td>3</td>
                                            <td>{!! nl2br(e($appraisal->question_three)) !!}</td>
                                            <td><input type="text" name="self_score[]"  placeholder="" value="{{$scores[2]->self_score}}" readonly></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly>{{$scores[2]->self_comment}}</textarea>
                                            </td>
                                            <td><input type="text" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_four)
                                        <tr>
                                            <td>4</td>
                                            <td>{!! nl2br(e($appraisal->question_four)) !!}</td>
                                            <td><input type="text" name="self_score[]"  placeholder="" value="{{$scores[3]->self_score}}" readonly></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly>{{$scores[3]->self_comment}}</textarea>
                                            </td>
                                            <td><input type="text" name="supervisor_score[]"  placeholder="" required></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" required></textarea>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($appraisal->question_five)
                                        <tr>
                                            <td>5</td>
                                            <td>{!! nl2br(e($appraisal->question_five)) !!}</td>
                                            <td><input type="text" name="self_score[]"  placeholder="" value="{{$scores[4]->self_score}}" readonly></td>
                                            <td>
                                                <textarea name="supervisor_comment[]" id="" cols="30" rows="5" readonly>{{$scores[4]->self_comment}}</textarea>
                                            </td>
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
                                            <textarea name="self_overall_comment" id="" cols="100%" rows="5" readonly>{{$appraisal->pmo_overall_comment}}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Initials:</td>
                                        <td colspan="2">
                                            <input type="text" name="self_signature" value="{{$appraisal->pmo_signature}}" readonly>
                                        </td>
                                        <td >Date</td>
                                        <td colspan="2">
                                            <input type="date" name="self_sign_date" value="{{$appraisal->pmo_sign_date}}" readonly>
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







