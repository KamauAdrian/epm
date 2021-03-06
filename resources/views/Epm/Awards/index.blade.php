@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Awards</h1>
            </div>
            <div class="col-md-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin')
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/new/award')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Create Award</button>
                    </a>
                @endif
{{--                <a href="#!">--}}
{{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="AwardsListTable" class="table table-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th>Award</th>
                                        <th>Position One</th>
                                        <th>Position Two</th>
                                        <th>Position Three</th>
{{--                                        <th class="text-right">Actions</th>--}}
                                    </tr>
                                </thead>
                                @if($awards!='')
                                    <tbody>
                                    @foreach($awards as $award)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
{{--                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/award',$award->id)}}">--}}
                                                            <h5 class="mb-1">{{$award->name}}</h5>
{{--                                                        </a>--}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                    @if($award->position_one)
                                                        <?php
                                                        $winner_position_one = \App\Models\User::find($award->position_one);
                                                        $image = '';
                                                        $profile_image = $winner_position_one->image;
                                                        if ($profile_image==null){
                                                            $gender = $winner_position_one->gender;
                                                            if ($gender=="Male"){
                                                                $image = 'assets/images/male.jpeg';
                                                            }else{
                                                                $image = 'assets/images/female.jpeg';
                                                            }
                                                        }else{
                                                            $role = $winner_position_one->role->name;
                                                            if ($role=="Center Manager"){
                                                                $image = "CenterManagers/images/".$profile_image;
                                                            }
                                                            if ($role=="Project Manager"){
                                                                $image = "ProjectManagers/images/".$profile_image;
                                                            }
                                                        }
                                                        ?>
                                                    @endif
                                                        <a href="{{url("adm/view/adm/".$winner_position_one->id."/profile/role_id=".$winner_position_one->role_id)}}">
                                                            <div class="media">
                                                            <img src="{{url($image)}}" alt="images" class="img-fluid avtar avtar-s">
                                                            <div class="media-body ml-3 align-self-center">
                                                                <h5 class="mb-1">{{$winner_position_one->name}}</h5>
    {{--                                                                <p class="mb-0">Chicago</p>--}}
                                                            </div>
                                                            </div>
                                                        </a>
                                            </td>
                                            <td>
                                                    @if($award->position_two)
                                                        <?php
                                                        $winner_position_two = \App\Models\User::find($award->position_two);
                                                    $image = '';
                                                    $profile_image = $winner_position_two->image;
                                                    if ($profile_image==null){
                                                        $gender = $winner_position_two->gender;
                                                        if ($gender=="Male"){
                                                            $image = 'assets/images/male.jpeg';
                                                        }else{
                                                            $image = 'assets/images/female.jpeg';
                                                        }
                                                    }else{
                                                        $role = $winner_position_two->role->name;
                                                        if ($role=="Center Manager"){
                                                            $image = "CenterManagers/images/".$profile_image;
                                                        }
                                                        if ($role=="Project Manager"){
                                                            $image = "ProjectManagers/images/".$profile_image;
                                                        }
                                                    }
                                                    ?>
                                                @endif
                                                <a href="{{url("adm/view/adm/".$winner_position_two->id."/profile/role_id=".$winner_position_two->role_id)}}">
                                                    <div class="media">
                                                        <img src="{{url($image)}}" alt="images" class="img-fluid avtar avtar-s">
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1">{{$winner_position_two->name}}</h5>
                                                            {{--                                                                <p class="mb-0">Chicago</p>--}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                    @if($award->position_three)
                                                        <?php
                                                        $winner_position_three = \App\Models\User::find($award->position_three);
                                                    $image = '';
                                                    $profile_image = $winner_position_three->image;
                                                    if ($profile_image==null){
                                                        $gender = $winner_position_three->gender;
                                                        if ($gender=="Male"){
                                                            $image = 'assets/images/male.jpeg';
                                                        }else{
                                                            $image = 'assets/images/female.jpeg';
                                                        }
                                                    }else{
                                                        $role = $winner_position_three->role->name;
                                                        if ($role=="Center Manager"){
                                                            $image = "CenterManagers/images/".$profile_image;
                                                        }
                                                        if ($role=="Project Manager"){
                                                            $image = "ProjectManagers/images/".$profile_image;
                                                        }
                                                    }
                                                    ?>
                                                @endif
                                                <a href="{{url("adm/view/adm/".$winner_position_three->id."/profile/role_id=".$winner_position_three->role_id)}}">
                                                    <div class="media">
                                                        <img src="{{url($image)}}" alt="images" class="img-fluid avtar avtar-s">
                                                        <div class="media-body ml-3 align-self-center">
                                                            <h5 class="mb-1">{{$winner_position_three->name}}</h5>
                                                            {{--                                                                <p class="mb-0">Chicago</p>--}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>

{{--                                            @if($auth_admin->role->name != 'Su Admin')--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <div class="float-right">--}}
{{--                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/award/'.$award->id)}}" class="btn btn-sm btn-outline-info" title="View">--}}
{{--                                                            <span><i class="fa fa-list"></i></span>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            @else--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <div class="float-right">--}}
{{--                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View">--}}
{{--                                                            <span><i class="fa fa-list"></i></span>--}}
{{--                                                        </a>--}}
{{--                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Edit">--}}
{{--                                                            <span><i class="fa fa-pencil-alt"></i></span>--}}
{{--                                                        </a>--}}
{{--                                                        <div  data-url="#!" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal"  title="Delete">--}}
{{--                                                            <span><i class="fa fa-trash"></i></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="float-right">--}}
{{--                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/award/'.$award->id)}}" class="btn btn-sm btn-outline-info" title="View">--}}
{{--                                                            <span><i class="fa fa-list"></i></span>--}}
{{--                                                        </a>--}}
{{--                                                        <a href="{{url('/adm/'.$auth_admin->id.'/edit/award/'.$award->id)}}" class="btn btn-sm btn-outline-info" title="Edit">--}}
{{--                                                            <span><i class="fa fa-pencil-alt"></i></span>--}}
{{--                                                        </a>--}}
{{--                                                        <div  data-url="{{url('/adm/'.$auth_admin->id.'/delete/award/'.$award->id)}}" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal"  title="Delete">--}}
{{--                                                            <span><i class="fa fa-trash"></i></span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            @endif--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                @if($auth_admin->role->name == 'Su Admin')
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/new/award')}}" class="mb-0 text-body">Create Award</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        $(document).ready(function (){
            $("#AwardsListTable").dataTable({
                "order":[],
            });
        });
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedAdmin: null,
                    admins: [],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/list/all/users')
                        .then(response => {
                            this.admins = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#adminsList')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
