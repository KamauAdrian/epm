@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 text-center mb-4">
                    <h1 class="d-inline-block mb-0 font-weight-normal">Complete Tasks</h1>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="tableListDataTable">
                        <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Due Date</th>
                            <th>Work Stream</th>
                            <th>Assignees</th>
                        </tr>
                        </thead>
                        @if(count($tasks)>0)
                            <tbody>
                            @foreach($tasks as $task)
                                <?php
                                $due_date = date("dS M Y",strtotime($task->due_date));
                                $task_assignees = $task->assignees;
                                $assignees = [];
                                if ($task_assignees){
                                    foreach ($task_assignees as $task_assignee){
                                        $name = $task_assignee->name;
                                        $split_name = explode(" ",$name);
                                        if (count($split_name)>0){
                                            $assignees[] = $split_name[0];
                                        }else{
                                            $assignees[] = $name;
                                        }
                                    }
                                }
                                ?>
                                <tr>
                                    <td>{{$task->name}}</td>
                                    <td>{{$due_date}}</td>
                                    <td>{{$task->project->name}}</td>
                                    <td>{{implode(", ",$assignees)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
@endsection
