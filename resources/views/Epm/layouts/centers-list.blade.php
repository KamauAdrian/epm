<?php
$auth_admin = auth()->user();
?>

<center>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{session()->get('success')}}</h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>{{session()->get('error')}}</h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</center>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="CentersList" class="table table-center mb-0 ">
                <thead>
                <tr>
                    <th>Centers</th>
                    <th>County</th>
                    <th>Town</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                @if($centers!='')
                    <tbody>
                    @foreach($centers as $center)
                        <tr>
                            <td>
                                <div class="media">
                                    <span class="avtar"><img src="{{url('assets/images/center.jpeg')}}" alt="images" class="img-fluid"></span>
                                    <div class="media-body ml-3 align-self-center">
                                        <h5 class="mb-1">{{$center->name}}</h5>
                                    </div>
                                </div>
                            </td>
                            <td>{{$center->county}}</td>
                            <td>{{$center->location}}</td>
                            @if(auth()->user()->role->name == 'Su Admin' || auth()->user()->role->name == 'Project Manager')
                                <td class="text-right">
                                    <div class="float-right">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/center',$center->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                <span><i class="fa fa-list"></i></span>
                                            </a>
                                            <a href="{{url('/adm/'.$auth_admin->id.'/edit/center',$center->id)}}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <span><i class="fa fa-pencil-alt"></i></span>
                                            </a>
                                            <a href="#!" data-url="{{url('/adm/'.$auth_admin->id.'/delete/center',$center->id)}}" class="btn btn-sm btn-outline-danger deleteCenter" data-toggle="modal" data-target="#deleteCenter" title="Delete">
                                                <span><i class="fa fa-trash"></i></span>
                                            </a>
                                    </div>
                                </td>
                            @else
                                <td class="text-right">
                                    <div class="float-right">
                                        <a href="{{url('/view/center',$center->id)}}" class="btn btn-sm btn-outline-info" title="View">
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
        </div>
    </div>
</div>

<div class="modal fade" id="deleteCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <h5 class="text-danger">Are you sure you want to delete this Center?</h5>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-success">Yes Delete</button>
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
