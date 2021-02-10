@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Projects</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/new/project')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Create a New Project</button>
                    </a>
{{--                <a href="#!">--}}
{{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="row">
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
            <div class="table-responsive">
                <table class="table" id="tableProjects">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Collaborators</th>
                            <th>Due Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    @if($projects)
                        <tbody>
                           @foreach($projects as $project)
                               <tr>
                                   <td>{{$project->name}}</td>
                                   <?php $collaborators = \App\Models\Project::find($project->id)->collaborators; ?>
                                   <td>
                                       @foreach($collaborators as $collaborator)
                                           {{$collaborator->name}}<br />
                                       @endforeach
                                   </td>
                                   <td>{{date('l dS M Y',strtotime($project->due_date))}}</td>
                                   <td class="text-right">
                                       <div class="float-right">
                                           <a href="{{url('/adm/'.$auth_admin->id.'/view/project/'.$project->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                               <span><i class="fa fa-list"></i></span>
                                           </a>
                                           <a href="{{url('/adm/'.$auth_admin->id.'/edit/project/'.$project->id)}}" class="btn btn-sm btn-outline-info" title="Edit">
                                               <span><i class="fa fa-pencil-alt"></i></span>
                                           </a>
                                           <a  data-url="{{url('/adm/'.$auth_admin->id.'/delete/project/'.$project->id)}}" class="btn btn-sm btn-outline-danger deleteProject" data-toggle="modal"  title="Delete">
                                               <span class="text-danger"><i class="fa fa-trash"></i></span>
                                           </a>
                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
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
            $('#tableProjects').DataTable();
        });

    </script>
@endsection
