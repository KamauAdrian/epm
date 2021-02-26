@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">{{$project->name}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table" id="tableProjectTasks">
                    <thead>
                    <tr>
                        <th>Date Opened</th>
                        <th>Task</th>
                        <th>Collaborators Involved</th>
                        <th>Due Date</th>
                        <th>Completion Date</th>
                        <th class="text-right">Status</th>
                    </tr>
                    </thead>
                    <?php $tasks = $project->tasks ?>
                    @if($tasks)
                        <tbody>
                            @foreach($tasks as $task)
{{--                                <tr>--}}
{{--                                    <td>{{$task->created_at}}</td>--}}
{{--                                    <td>{{$task->name}}</td>--}}
{{--                                    <td>{{$task->name}}</td>--}}
{{--                                    <td>{{$task->due_date}}</td>--}}
{{--                                </tr>--}}
                            @endforeach
                        </tbody>
                    @endif
                    <tfoot>
                        <tr>
                            <th>Date Opened</th>
                            <th>Task</th>
                            <th>Collaborators Involved</th>
                            <th>Due Date</th>
                            <th>Completion Date</th>
                            <th class="text-right">Status</th>
                        </tr>
                    </tfoot>
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
