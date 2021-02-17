@inject('centerDetails','App\Models\Center')
<?php
$auth_admin = auth()->user();
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12 mb-4">
            <h1 class="d-inline-block font-weight-normal mb-0">{{$center->name}} Profile</h1>
            <a href="{{url('/adm/'.$auth_admin->id.'/edit/center',$center->id)}}">
                <button class="btn btn-outline-info float-right">Edit Profile</button>
            </a>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="{{url('assets/images/center.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
        </div>
        <div class="col-md-8">
{{--            <h6><span class="text-small" style="font-size: 14px">Name:</span></h6>--}}
{{--            <h3 class="d-inline-block font-weight-normal">{{$center->name}}</h3>--}}
            @if($center->description)
                <h6><span class="text-small" style="font-size: 14px">Center Description:</span></h6>
                <p style="font-size: 12px;">{{$center->description}}</p>
            @endif
            <div class="row my-4">
                <div class="col-sm-6">
                    <h6><span class="text-small" style="font-size: 14px">County:</span></h6>
                    <p style="font-size: 12px;">{{$center->county}}</p>
                    <h6><span class="text-small" style="font-size: 14px">Town:</span></h6>
                    <p class="mb-3" style="font-size: 12px;">{{$center->location}}</p>
                </div>
                <div class="col-sm-6">
                    <h6><span class="text-small" style="font-size: 14px">Center Managers:</span></h6>
                    <?php
                    $centerManagers = $centerDetails::find($center->id)->centerManagers;
                    ?>
                    @foreach($centerManagers as $centerManager)
                        <?php
                        $split_name = explode(' ',$centerManager->name);
                        $avatar_icon_name = '';
                        if (count($split_name)>1){
                            $avatar_icon_name = substr($split_name[0],0,1).substr(end($split_name),0,1);
                        }else{
                            $avatar_icon_name = substr($centerManager->name,0,1);
                        }
                        ?>
                        <span class="avtar text-blue-2 bg-blue-1 mr-3 mb-3" >{{$avatar_icon_name}}</span>
                    @endforeach
                    <a href="#!" title="Add New Cm To This Center">
                        {{--        <a href="{{url('/session/'.$trainingSession->id.'/add/trainers')}}" title="Add New Trainer To This Session">--}}
                        <button type="button" class="btn btn-icon icon-lg"><i class="feather icon-plus"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
