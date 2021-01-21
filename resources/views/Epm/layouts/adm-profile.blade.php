@inject('user','App\Models\User')
<?php
$admin_user = $user::find($admin->id);
?>
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
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    @if($admin_user->role->name == 'Project Manager')
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/list/all/admins/role_id='.$admin_user->role->id)}}">pms</a></li>
                            <li class="breadcrumb-item"><a href="#!">{{$admin_user->name}}</a></li>
                        </ul>
                    @elseif($admin_user->role->name == 'Center Manager')
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/list/all/admins/role_id='.$admin_user->role->id)}}">cms</a></li>
                            <li class="breadcrumb-item"><a href="#!">{{$admin_user->name}}</a></li>
                        </ul>
                    @endif
                    @if(auth()->user()->role->name == 'Su Admin')
                        <a href="{{url('/adm/edit/adm/'.$admin_user->id.'/profile/role_id='.$admin_user->role->id)}}">
                            <button class="btn btn-outline-info float-right">Edit Profile</button>
                        </a>
                    @endif
{{--                    <ul class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="#!">Clients</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="#!">Apple, Inc.</a></li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-center">
        @if($admin_user->image)
            @if($admin_user->role->name == 'Project Manager')
                <div class="col-md-4">
                    <img src="{{url('ProjectManagers/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                </div>
            @elseif($admin_user->role->name == 'Center Manager')
                <div class="col-md-4">
                    <img src="{{url('CenterManagers/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                </div>
            @elseif($admin_user->role->name == 'Trainer')
                <div class="col-md-4">
                    <img src="{{url('Trainers/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                </div>
            @elseif($admin_user->role->name == 'Mentor')
                <div class="col-md-4">
                    <img src="{{url('Mentors/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                </div>
            @endif
        @else
            @if($admin_user->gender == 'Male')
                <div class="col-md-4">
                    <img src="{{url('assets/images/male.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
                </div>
            @else
                <div class="col-md-4">
                    <img src="{{url('assets/images/female.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
                </div>
            @endif
        @endif
        <div class="col-md-8">
            @if($admin_user->name)
            <h6><span class="text-small" style="font-size: 14px">Name:</span></h6>
            <h3 class="d-inline-block font-weight-normal">{{$admin_user->name}}</h3>
            @endif
            @if($admin_user->bio)
                <h6><span class="text-small" style="font-size: 14px">Bio:</span></h6>
                <p style="font-size: 12px;">{{$admin_user->bio}}</p>
            @endif
            <div class="row my-4">
                <div class="col-sm-6">
                    @if($admin_user->email)
                    <h6><span class="text-small" style="font-size: 14px">Email:</span></h6>
                    <p style="font-size: 12px;">{{$admin_user->email}}</p>
                    @endif
                    @if($admin_user->phone)
                        <h6><span class="text-small" style="font-size: 14px">Phone:</span></h6>
                        <p class="mb-3" style="font-size: 12px;">{{$admin_user->phone}}</p>
                    @endif
                    @if($admin_user->gender)
                        <h6><span class="text-small" style="font-size: 14px">Gender:</span></h6>
                        <p style="font-size: 12px;" class="mb-3">{{$admin_user->gender}}</p>
                    @endif
                </div>
                <div class="col-sm-6">
                    @if($admin_user->county)
                        <h6><span class="text-small" style="font-size: 14px">County:</span></h6>
                        <p style="font-size: 12px;" class="mb-3">{{$admin_user->county}}</p>
                    @endif
                    @if($admin_user->location)
                        <h6><span class="text-small" style="font-size: 14px">Location:</span></h6>
                        <p style="font-size: 12px;" class="mb-3">{{$admin_user->location}}</p>
                    @endif
                    @if($admin_user->department)
                        <h6><span class="text-small" style="font-size: 14px">Department:</span></h6>
                        <p style="font-size: 12px;" class="mb-3">{{$admin_user->department}}</p>
                    @endif
                    @if($admin_user->speciality)
                        <h6><span class="text-small" style="font-size: 14px">Speciality:</span></h6>
                        <p style="font-size: 12px;" class="mb-3">{{$admin_user->speciality}}</p>
                    @endif
                    @if($admin_user->center_id)
                        <h6><span class="text-small" style="font-size: 14px">Center:</span></h6>
                        <p style="font-size: 12px;" class="mb-3">{{$admin_user->center->name}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
