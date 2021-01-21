<?php
$auth_admin = auth()->user();
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center mb-4">
            <h1 class="d-inline-block mb-0 font-weight-normal">{{$template->name}}</h1>
            {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
        </div>
        <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
            <a href="{{url('/adm/'.$auth_admin->id.'/submit/report/'.$template->id)}}">
                <button class="btn btn-outline-info btn-lg">Submit Report</button>
            </a>
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
        </div>
            <div class="col-sm-12 text-center">
                <span><h3>Previously Submitted Reports</h3></span>
            </div>

                    <table class="table table-center mb-0 ">
                        <thead>
                        <tr> <th>Report</th> <th>Date</th> <th class="text-right">Actions</th> </tr>
                        </thead>
                        @if($reports)
                            <tbody>
                            @foreach($reports as $report)
                                <?php
                                $report_date = $report->date_of_report;
                                $format_date = date('l dS M Y',strtotime($report_date));
                                //                    dd($format_date);
                                ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-body ml-3 align-self-center">
                                                <h5 class="mb-1">{{$report->name}}</h5>
                                                <p class="mb-0">{{$report->employee_number}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$format_date}}</td>
                                    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                        <td class="text-right">
                                            <div class="float-right">
                                                <a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                    {{--                                                    <a href="{{url('/adm/view/adm/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="View">--}}
                                                    <span><i class="fa fa-list"></i></span>
                                                </a>
                                                <a href="#!" class="btn btn-sm btn-outline-info" title="Edit">
                                                    {{--                                                    <a href="{{url('/adm/edit/adm/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="Edit">--}}
                                                    <span><i class="fa fa-pencil-alt"></i></span></a>
                                                <a href="#!" data-url="#!" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal" data-target="#deleteAdmin" title="Delete">
                                                    {{--                                                    <a href="#!" data-url="{{url('/delete/admin/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal" data-target="#deleteAdmin" title="Delete">--}}
                                                    <span><i class="fa fa-trash"></i></span>
                                                </a>
                                            </div>
                                        </td>
                                    @else
                                        <td class="text-right">
                                            <div class="float-right">
                                                <a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                    <span><i class="fa fa-list"></i></span>
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
{{--                        <div class="col-sm-6">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h6>{{$template->name}} submitted {{$format_date}}</h6>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="row" >--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/report_id='.$report->id)}}">--}}
{{--                                                <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Report</p></button>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <a href="#!">--}}
{{--                                                <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Report</p></button>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

    </div>
</div>
