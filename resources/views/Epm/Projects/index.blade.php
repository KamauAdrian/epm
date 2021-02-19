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
            <div class="table-responsive">
                <table class="table" id="tableProjects">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Date Opened</th>
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
                                                       <a href="{{url('/adm/'.$auth_admin->id.'/delete/project/'.$project->id)}}">
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
                        <tfoot>
                        <tr>
                            <th>Project</th>
                            <th>Date Opened</th>
                            <th>Collaborators</th>
                            <th>Due Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </tfoot>
                    @endif
                </table>
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
        $(document).ready(function (){
            $('#tableProjects').DataTable(
                {
                    "order": [],
                }
            );
        });

    </script>
@endsection
