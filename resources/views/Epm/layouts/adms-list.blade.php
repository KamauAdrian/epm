@inject('user','App\Models\User')
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center mb-4">
            @if($role->name == 'Project Manager')
                <h1 class="d-inline-block mb-0 font-weight-normal">Project Managers</h1>
            @elseif($role->name == 'Center Manager')
                <h1 class="d-inline-block mb-0 font-weight-normal">Center Managers</h1>
            @elseif($role->name == 'Trainer')
                <h1 class="d-inline-block mb-0 font-weight-normal">Trainers</h1>
            @elseif($role->name == 'Mentor')
                <h1 class="d-inline-block mb-0 font-weight-normal">Mentors</h1>
            @endif
            {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
        </div>
        <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
            <?php
            $auth_admin = auth()->user();
            $url = '';
            if ($role->name == 'Project Manager'){
                $url = 'adm/'.$auth_admin->id.'/add/admin/role_name='.$role->name;
            }elseif ($role->name == 'Center Manager'){
                $url = 'adm/'.$auth_admin->id.'/add/admin/role_name='.$role->name;
            }
            elseif ($role->name == 'Trainer'){
                $url = 'adm/'.$auth_admin->id.'/add/admin/role_name='.$role->name;
            }
            elseif ($role->name == 'Mentor'){
                $url = 'adm/'.$auth_admin->id.'/add/admin/role_name='.$role->name;
            }
            ?>
                @if($auth_admin->role->name == 'Su Admin')
                    <a href="{{url('/'.$url)}}">
                        @if($role->name == 'Project Manager')
                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add PMO</button>
                        @else
                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add {{$role->name}}</button>
                        @endif
                    </a>
                @endif
                @if($auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/'.$url)}}">
                        @if($role->name != 'Project Manager')
                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add {{$role->name}}</button>
                        @endif
                    </a>
                @endif
            <a href="#!">
                <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
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

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-center mb-0">
                            @if($role->name == 'Project Manager')
                                <thead>
                                <tr> <th>Project Manager</th> <th>Active Projects</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                            @elseif($role->name == 'Center Manager')
                                <thead>
                                <tr> <th>Center Manager</th> <th>Center</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                            @elseif($role->name == 'Trainer')
                                <thead>
                                <tr> <th>Trainers</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                            @elseif($role->name == 'Mentor')
                                <thead>
                                <tr> <th>Mentors</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                            @endif
                            @if($admins)
                                <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                @if($admin->image)
                                                    @if($role->name == 'Project Manager')
                                                        <span><img src="{{url('ProjectManagers/images',$admin->image)}}" alt="images" class="avtar img-fluid"></span>
                                                    @elseif($role->name == 'Center Manager')
                                                        <span><img src="{{url('CenterManagers/images',$admin->image)}}" alt="images" class="avtar img-fluid"></span>
                                                    @elseif($role->name == 'Trainer')
                                                        <span><img src="{{url('Trainers/images',$admin->image)}}" alt="images" class="avtar img-fluid"></span>
                                                    @elseif($role->name == 'Mentor')
                                                        <span><img src="{{url('Mentors/images',$admin->image)}}" alt="images" class="avtar img-fluid"></span>
                                                    @endif
                                                    @else
                                                    <?php
                                                    $name = $admin->name;
                                                    $id = $admin->id;
                                                    $split_name = explode(' ',$name);
                                                    $avatar_icon = '';
                                                    if (count($split_name)>1){
                                                        $avatar_icon = substr($split_name[0],0,1).substr(end($split_name),0,1);
                                                    }else{
                                                        $avatar_icon = substr($name,0,1);
                                                    }
                                                    ?>
                                                    @if($admin->gender =='Male')
                                                        <span class="avtar"><img src="{{url('assets/images/male.jpeg')}}" alt="images" class="img-fluid"></span>
                                                    @elseif($admin->gender =='Female')
                                                        <span class="avtar"><img src="{{url('assets/images/female.jpeg')}}" alt="images" class="img-fluid"></span>
                                                    @endif
                                                @endif
                                                <div class="media-body ml-3 align-self-center">
                                                    <h5 class="mb-1">{{$admin->name}}</h5>
                                                    <p class="mb-0">{{$admin->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        @if($role->name == 'Project Manager')
                                            <td>9 <i class="feather icon-arrow-up text-success"></i></td>
                                        @elseif($role->name == 'Center Manager')
                                            <?php
                                            $center = '';
                                            if ($admin->center_id!=null){
                                                $center = $user::find($admin->id)->center->name;
                                            }
                                            ?>
                                            @if($center)
                                                <td>{{$center}}</td>
                                            @else
                                                <td>Not Assigned To a Center</td>
                                            @endif
                                        @endif
                                        @if($auth_admin->role->name != 'Su Admin')
                                            <td class="text-right">
                                                <div class="float-right">
                                                    <a href="{{url('/adm/view/adm/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                        <span><i class="fa fa-list"></i></span>
                                                    </a>
                                                </div>
                                            </td>
                                        @else
                                            <td class="text-right">
                                                <div class="float-right">
                                                    <a href="{{url('/adm/view/adm/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                        <span><i class="fa fa-list"></i></span>
                                                    </a>
                                                    <a href="{{url('/adm/edit/adm/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="Edit">
                                                        <span><i class="fa fa-pencil-alt"></i></span></a>
                                                    <a href="#!" data-url="{{url('/delete/admin/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal" data-target="#deleteAdmin" title="Delete">
                                                        <span><i class="fa fa-trash"></i></span>
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

            <div class="modal fade" id="deleteAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <h5 class="text-danger">Are you sure you want to delete this Admin?</h5>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteAdminForm" action="" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-success">Yes Delete</button>
                                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($auth_admin->role->name == 'Su Admin')
                @if($role->name == 'Project Manager')
                    <a href="{{url('/'.$url)}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add PMO</a>
                @else
                    <a href="{{url('/'.$url)}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add {{$role->name}}</a>
                @endif
            @endif
            @if($auth_admin->role->name == 'Project Manager')
                @if($role->name != 'Project Manager')
                    <a href="{{url('/'.$url)}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add {{$role->name}}</a>
                @endif
            @endif
        </div>
    </div>
</div>

