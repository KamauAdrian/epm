@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    $date = date("Y-m-d");
    $date_7_days_later = date("Y-m-d",strtotime("+7 days",strtotime($date)));
//    dd($date_7_days_later);
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">{{$project->name}}</h1>
                <div id="projectId" style="display: none">{{$project->id}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tasks</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div id="inCompleteTasks"></div>
                                                    <h5 class="text-primary">Incomplete Tasks</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div id="completeTasks"></div>
                                                    <h5 class="text-success">Complete Tasks</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div id="overDueTasks"></div>
                                                    {{--                                <h5 class="text-danger">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>--}}
                                                    <h5 class="text-danger">Overdue Tasks</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableProjectTasks">
                    <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Task</th>
                        <th>Date Opened</th>
                        <th>Collaborators Involved</th>
                        <th>Due Date</th>
                        <th>Completion Date</th>
                        <th class="text-right">Status</th>
                    </tr>
                    </thead>
                    <?php
                    $activities = $project->activities;
//                    $tasks = $project->tasks;
//                    dd($activities,$tasks);
                    ?>
                    @if($activities)
                        @foreach($activities as $key=>$activity)
                        <tbody>
                            <?php
                            $tasks_raw = $activity->tasks;
                            $tasks_array = [];
                            foreach ($tasks_raw as $task_raw){
                                $tasks_array[] = $task_raw;
                            }
                            $tasks = array_slice($tasks_array,1);
//                                dd($tasks);
                            ?>
                            @if(count($tasks_raw)>=1)
                                <tr>
                                    <td rowspan="{{count($tasks_raw)}}">{{$activity->name}}</td>
                                    <td>{{$tasks_array[0]->name}}</td>
                                    <td>{{date("dS M Y",strtotime($tasks_array[0]->created_at))}}</td>
                                    <td>
                                        <?php
                                        $task_assignees = $tasks_array[0]->assignees;
                                        $task_assignees_names = [];
                                        foreach ($task_assignees as $task_assignee){
                                            $names = $task_assignee->name;
                                            $split_name = explode(" ",$names);
                                            if (count($split_name)>1){
                                                $task_assignees_names[] = $split_name[0];
                                            }else{
                                                $task_assignees_names[] = $names;
                                            }
                                        }
                                        ?>
                                        @foreach($task_assignees_names as $task_assignee_name)
                                            {{$task_assignee_name}}<br />
                                        @endforeach
                                    </td>
                                    <td>{{date("dS M Y",strtotime($tasks_array[0]->due_date))}}</td>
                                    @if($tasks_array[0]->completion_date)
                                    <td>{{date("dS M Y",strtotime($tasks_array[0]->completion_date))}}</td>
                                    @else
                                        <td class="text-center">-</td>
                                    @endif
                                    <td>
                                        @if($tasks_array[0]->status ==0)
                                            In Complete
                                        @else
                                            Complete
                                        @endif
                                    </td>
                                </tr>
                                @if($tasks)
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{{$task->name}}</td>
                                            <td>{{date("dS M y",strtotime($task->created_at))}}</td>
                                            <td>
                                                <?php
                                                $task_assignees = $task->assignees;
                                                $task_assignees_names = [];
                                                foreach ($task_assignees as $task_assignee){
                                                    $names = $task_assignee->name;
                                                    $split_name = explode(" ",$names);
                                                    if (count($split_name)>1){
                                                        $task_assignees_names[] = $split_name[0];
                                                    }else{
                                                        $task_assignees_names[] = $names;
                                                    }
                                                }
                                                ?>
                                                @foreach($task_assignees_names as $task_assignee_name)
                                                    {{$task_assignee_name}}
                                                @endforeach
                                            </td>
                                            <td>{{date("dS M Y",strtotime($task->due_date))}}</td>
                                            @if($task->completion_date)
                                                <td>{{date("dS M Y",strtotime($task->completion_date))}}</td>
                                            @else
                                                <td class="text-center">-</td>
                                            @endif
                                            <td>
                                                @if($task->status ==0)
                                                    In Complete
                                                @else
                                                    Complete
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @else
                                <tr>
                                    <td>{{$activity->name}}</td>
                                    <td class="text-center" colspan="5">No Tasks Yet for This Activity</td>
                                </tr>
                            @endif
                        </tbody>
                        @endforeach
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
            var project_id = document.getElementById("projectId").innerText;
            axios.get('/adm/get/project/'+project_id+'/overdue/tasks').then(function(response) {
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
            var project_id = document.getElementById("projectId").innerText;
            axios.get('/adm/get/project/'+project_id+'/complete/tasks').then(function(response) {
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
            var project_id = document.getElementById("projectId").innerText;
            axios.get('/adm/get/project/'+project_id+'/incomplete/tasks').then(function(response) {
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
            $('#tableProjectTasks').DataTable(
                {
                    "order": [],
                }
            );
        });

    </script>
@endsection
