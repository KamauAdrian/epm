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
{{--                <form action="{{url('/adm/'.$auth_admin->id.'/save/report/'.$report->id)}}" method="post">--}}
                <form action="{{url('adm/'.$auth_admin->id.'/save/performance/appraisal')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{$auth_admin->name}}" required>
{{--                                        <input type="hidden" name="report_template_id" class="form-control" value="{{$report->id}}">--}}
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" value="{{old('title')}}" required>
                                {{--                                        <input type="hidden" name="report_template_id" class="form-control" value="{{$report->id}}">--}}
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
                                        <tr>
                                            <td>1</td>
                                            <td>Program 1 Management- <br /> Operationalization of AYECs. – <br />40%</td>
                                            <td><input type="text" name="self_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="self_comment[]" style="border: none;" required></td>
                                            <td><input type="text" name="supervisor_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="supervisor_comment[]" style="border: none;" required></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Leadership – Support <br /> to Ajira Program Assistant <br /> Managers & Centre <br /> Managers. –
                                                30%</td>
                                            <td><input type="text" name="self_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="self_comment[]" style="border: none;" required></td>
                                            <td><input type="text" name="supervisor_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="supervisor_comment[]" style="border: none;" required></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Networking, Linkages & Partnerships in AYECs. – 20%</td>
                                            <td><input type="text" name="self_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="self_comment[]" style="border: none;" required></td>
                                            <td><input type="text" name="supervisor_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="supervisor_comment[]" style="border: none;" required></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Reporting, Monitoring <br /> & Evaluation. –
                                                10%</td>
                                            <td><input type="text" name="self_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="self_comment[]" style="border: none;" required></td>
                                            <td><input type="text" name="supervisor_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="supervisor_comment[]" style="border: none;" required></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>TOTALS</td>
                                            <td><input type="text" name="self_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="self_comment[]" style="border: none;" required></td>
                                            <td><input type="text" name="supervisor_score[]" style="border: none;" placeholder="" required></td>
                                            <td><input type="text" name="supervisor_comment[]" style="border: none;" required></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="5">Please provide supporting documentation (attachments and/or links) in line with the listed KPIs for your appraisal.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Individual’s overall comments:</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><input type="text" name="individual_comment" style="border: none;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Signature:</td>
                                            <td colspan="2">
                                                {{--                                                <input type="text" name="signatture" style="border: none;" required>--}}
                                            </td>
                                            <td >Date</td>
                                            <td colspan="2">
                                                <input type="date" name="date" style="border: none;" required>
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
                                                1) <input style="border: none;" name="improvement_areas[]" type="text"><br />
                                                2) <input style="border: none;" name="improvement_areas[]" type="text"><br />
                                                3) <input style="border: none;" name="improvement_areas[]" type="text"><br />
                                                4) <input style="border: none;" name="improvement_areas[]" type="text"><br />
                                                5) <input style="border: none;" name="improvement_areas[]" type="text"><br />
                                                6) <input style="border: none;" name="improvement_areas[]" type="text"><br />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Supervisor’s overall comments:</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <input type="text" style="border: none" placeholder="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Signature:</td>
                                            <td colspan="2">
                                                {{--                                                <input type="text" name="signatture" style="border: none;" required>--}}
                                            </td>
                                            <td >Date</td>
                                            <td colspan="2">
                                                <input type="date" name="date" style="border: none;" required>
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
        // function addActivity(){
        //     var myTr = document.getElementById('addNewActivity');
        //     var length = myTr.getAttribute('length');
        //     var tdx = document.createElement('td');
        //     var inputx = document.createElement('input');
        //     inputx.setAttribute('type','text');
        //     inputx.setAttribute('name','activity');
        //     inputx.setAttribute('required','required');
        //     inputx.style.border = 'none';
        //     tdx.appendChild(inputx);
        //     var tdy = document.createElement('td');
        //     var inputy = document.createElement('input');
        //     inputy.setAttribute('type','text');
        //     inputy.setAttribute('name','reports_quest');
        //     inputy.setAttribute('required','required');
        //     inputy.style.border = 'none';
        //     // tdy.appendChild(inputy);
        //     for ($i=0;$i<length;$i++){
        //         tdy.appendChild(inputy);
        //     }
        //     console.log(tdy);
        //     myTr.append(tdx,tdy);
        // }


        // console.log(document.getElementById('addNewActivity'));
        // function myAddActivityFunction(){
        //     var activity = document.getElementById('addNewActivity');
        //
        // }

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







