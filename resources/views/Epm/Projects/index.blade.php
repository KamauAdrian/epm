@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Work Streams</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/new/project')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Create a New Work Stream</button>
                    </a>
{{--                <a href="#!">--}}
{{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{url("/adm/".$auth_admin->id."/view/incomplete/tasks")}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <div id="inCompleteTasks"></div>
                            <h5 class="text-primary">Incomplete Tasks</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url("/adm/".$auth_admin->id."/view/complete/tasks")}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <div id="completeTasks"></div>
                            <h5 class="text-success">Complete Tasks</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url("/adm/".$auth_admin->id."/view/overdue/tasks")}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <div id="overDueTasks"></div>
                            <h5 class="text-danger">Overdue Tasks</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
            <div class="row">
            <div class="table-responsive">
                <table class="table" id="tableProjects">
                    <thead>
                        <tr>
                            <th>Work Streams</th>
                            <th>Date Created</th>
                            <th>Collaborators</th>
                            <th>Due Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    @if($projects)
                        <tbody>
                           @foreach($projects as $project)
                               <tr>
                                   <td><a href="{{url('/adm/'.$auth_admin->id.'/view/project/'.$project->id)}}">{{$project->name}}</a></td>
                                   <?php $collaborators = \App\Models\Project::find($project->id)->collaborators; ?>
                                   <td>{{date('l dS M Y',strtotime($project->created_at))}}</td>
                                   <td>
                                       @foreach($collaborators as $collaborator)
                                           {{$collaborator->name}}<br />
                                       @endforeach
                                   </td>
                                   <td>{{date('l dS M Y',strtotime($project->due_date))}}</td>
                                   <td class="text-right">
                                       <div class="btn-group float-right">
                                           <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                               <span class="badge badge-pill badge-light-dark">Action</span>
                                               <span class = "caret"></span>
                                           </button>
                                           <ul class = "dropdown-menu" role = "menu">
                                               <li>
                                                   <a href="{{url('/adm/'.$auth_admin->id.'/view/project/'.$project->id)}}">
                                                       View Work Stream
                                                   </a>
                                               </li>
                                               @if($auth_admin->id == $project->owner->id || $auth_admin->role->name=="Su Admin")
                                                   <li>
                                                       <a href="{{url('/adm/'.$auth_admin->id.'/edit/project/'.$project->id)}}">
                                                           Edit Work Stream
                                                       </a>
                                                   </li>
                                                   <li>
{{--                                                       please note done--}}
                                                       <a href="#!" class="deleteWorkStream" data-url="{{url('/adm/'.$auth_admin->id.'/delete/project/'.$project->id)}}">
                                                           Delete Work Stream
                                                       </a>
                                                   </li>
                                               @endif
                                           </ul>
                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
                <div class="modal fade" id="ModalDeleteWorkStream" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{--                    {{url('/adm-delete-pm','hiddenValue')}}--}}
                                <h5 class="text-danger">Are you sure you want to delete this Work Stream?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="" id="form-delete-work-stream" method="post">
                                    @csrf
                                    <button data-data="" id="btn-delete-user" type="submit" class="btn btn-outline-success">
                                        Yes Delete
                                    </button>
                                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '14px'
                            }
                        }
                    }
                },
                colors: ['#FF0B37'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Overdue'],
            }
            var chart = new ApexCharts(document.querySelector("#overDueTasks"), options);
            chart.render();
            axios.get('/adm/get/overdue/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '14px'
                            }
                        }
                    }
                },
                colors: ['#2DCA73'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Complete'],
            }
            var chart = new ApexCharts(document.querySelector("#completeTasks"), options);
            chart.render();
            axios.get('/adm/get/complete/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '14px'
                            }
                        }
                    }
                },
                colors: ['#0B69FF'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Incomplete'],
            }
            var chart = new ApexCharts(document.querySelector("#inCompleteTasks"), options);
            chart.render();
            axios.get('/adm/get/incomplete/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(".deleteWorkStream").click(function () {
            var url = $(this).attr('data-url');
            $("#form-delete-work-stream").attr("action",url);
            $("#ModalDeleteWorkStream").modal('show');
            console.log('this is the url'+ url);
        });
        $(document).ready(function (){
            $('#tableProjects').DataTable(
                {
                    "order": [],
                }
            );
        });

    </script>
@endsection
