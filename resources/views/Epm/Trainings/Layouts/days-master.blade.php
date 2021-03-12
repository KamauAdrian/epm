@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    $auth_admin = auth()->user();
    $trainers = $trainingDay->trainers;
    $trainees = $trainingDay->trainees;
    $classes = $trainingDay->classes;
    $sessions = $trainingDay->sessions;
    ?>
    <div class="col-md-12">
        <div class="row">
            @yield("sessionAllocations")
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Trainees</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{url("/adm/".$auth_admin->id."/view/training/".$trainingDay->training->id."/day/".$trainingDay->id."/trainees/register")}}" title="mark trainees register">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                            <span><i class="fa fa-clipboard-list"></i></span><br> <p class="align-self-center">Mark <br> Register</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url("/adm/".$auth_admin->id."/register/training/".$trainingDay->training->id."/day/".$trainingDay->id."/trainees")}}" title="Add Trainee">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-plus"></i></span> <br> <p class="align-self-center">Add <br>Trainee</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Communication</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" title="Email All Trainees">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-envelope"></i></span> <br> <p class="align-self-center">Email <br> Trainees</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!" title="SMS All Trainees">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                            <span><i class="fa fa-comment"></i></span> <br> <p class="align-self-center">SMS <br>Trainees</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Progress</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" title="Upload Photos">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;width: 150px;">
                                            <span><i class="fa fa-image"></i></span> <br> <p class="align-self-center">Upload <br> Images</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!" title="Impact Stories">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                            <span><i class="fa fa-pencil-alt"></i></span><p class="align-self-center">Impact <br> Stories </p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Comments</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" title="Upload Report">
                                        <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-comment"></i></span><p class="align-self-center">Add <br> Comment</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!" title="Upload Report">
                                        <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-book-open"></i></span><p class="align-self-center">View <br> Comments</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h6 class="text-small">Trainees</h6></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="traineesList" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Category</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                        @foreach($trainees as $trainee)--}}
                                {{--                            <tr>--}}
                                {{--                                <td>{{$trainee->name}}</td>--}}
                                {{--                                <td>{{$trainee->email}}</td>--}}
                                {{--                                <td>{{$trainee->phone_number}}</td>--}}
                                {{--                                <td>{{$trainee->gender}}</td>--}}
                                {{--                                <td>{{$trainee->category}}</td>--}}
                                {{--                                <td class="text-right">--}}
                                {{--                                    <div class="float-right">--}}
                                {{--                                        <a href="#!" class="btn btn-sm btn-outline-info">--}}
                                {{--                                            <span><i class="fa fa-envelope"></i></span>--}}
                                {{--                                        </a>--}}
                                {{--                                        <a href="#!" class="btn btn-sm btn-outline-info">--}}
                                {{--                                            <span><i class="fa fa-comment"></i></span>--}}
                                {{--                                        </a>--}}
                                {{--                                        <a href="#!" class="btn btn-sm btn-outline-danger">--}}
                                {{--                                            <span><i class="fa fa-trash"></i></span>--}}
                                {{--                                        </a>--}}
                                {{--                                    </div>--}}
                                {{--                                </td>--}}
                                {{--                            </tr>--}}
                                {{--                        @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalUpdateSessionFacilitators" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12" id="modalTrainingUpdate">
                            <form id="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12" style="display: none;">
                                        <div class="form-group">
                                            <label>Session Start Time</label>
                                            <input class="form-control" type="text" id="session_start_time" name="start_time" value="">
                                            <input class="form-control" type="hidden" id="training_id" value="{{$trainingDay->training->id}}">
                                            <input class="form-control" type="hidden" id="day_id" value="{{$trainingDay->id}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Session End Time</label>
                                            <input class="form-control" type="text" id="session_end_time" name="end_time" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" session_id="" id="trainingFacilitators" training_id="{{$trainingDay->training->id}}">
                                            <label>Select Session Facilitators</label>
                                            <multiselect v-model="selectedTrainers" :options="trainers"
                                                         placeholder="Select Trainers" label="name" :track-by="trackBy"
                                                         :searchable="true" :close-on-select="true" multiple>
                                            </multiselect>
                                            {{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                            <input id="session_facilitators" type="hidden" v-for="trainer in selectedTrainers" name="trainers[]" :value="trainer.id">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group float-right">
                                            <input type="submit" class="btn btn-outline-info" value="Save">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        $('.openModalUpdateSessionFacilitators').click(function(event){
            event.preventDefault();
            let formId = $(this).attr("id");
            let sessionId = $(this).attr("data-session_id");
            console.log(sessionId);
            let form = $("#modalTrainingUpdate").children(":first");
            $("#trainingFacilitators").attr("session_id",sessionId);
            form.attr("id","facilitatorsAddToSession_"+formId);
            let startTime = $("#start_time_session_"+formId).val();
            let endTime = $("#end_time_session_"+formId).val();
            $("#session_start_time").val(startTime);
            $("#session_end_time").val(endTime);

            $("#modalUpdateSessionFacilitators").modal('show');

            new Vue({
                el: "#trainingFacilitators",
                components: {
                    multiselect: window.VueMultiselect.default,
                    axios: window.axios.defaults,
                },
                data: function () {
                    return {
                        trackBy:"id",
                        selectedTrainers: [],
                        trainers: [],
                        initialValues: [],
                    }
                },
                methods:{
                    getTrainers: function(){
                        axios
                            .get("/training/"+this.$el.attributes.training_id.value+"/facilitators")
                            .then(response => {
                                this.trainers = response.data;
                                // this.allClasses = response.data;
                                // this.updateClasses();
                            })
                            .catch(error => {
                                console.log(error)
                                this.errored = true
                            })
                            .finally(() => this.loading = true);
                    },
                    // updateClasses: function () {
                    //     let total = this.allClasses.length;
                    //     for (i=0;i<total;i++){
                    //         let all = this.classes.push(this.allClasses[i]);
                    //     }
                    // },
                },
                mounted () {
                    this.getTrainers();
                },
                watch: {
                    trainers:{
                        immediate: false,
                        handler(values){
                            axios.get("/training/session/"+this.$el.attributes.session_id.value+"/facilitators").then(response => {this.initialValues = response.data;});
                            console.log(this.initialValues);
                        },
                    },
                    initialValues: {
                        immediate: true,
                        handler(values) {
                            this.selectedTrainers = this.trainers.filter(r => values.includes(r[this.trackBy]));
                        }
                    }
                },
            });
        });
        $("#modalUpdateSessionFacilitators").on("show.bs.modal",function (){
            let id = $("#modalTrainingUpdate").children(":first").attr("id");
            let formAddFacilitators = document.getElementById(id);
            // let formAddFacilitators = $(id);
            formAddFacilitators.onsubmit = function(event) {
                // Populate hidden form on submit
                // alert("submitting form");
                $.ajaxSetup({
                    header:$('meta[name="_token"]').attr('content')
                })
                event.preventDefault();
                var user_id = {{auth()->user()->id}};
                var training_id = $("#training_id").val();
                var day_id = $("#day_id").val();
                console.log(user_id,training_id,day_id);
                var startTime = $("#session_start_time").val();
                var endTime = $("#session_end_time").val();
                var trainers = $("#session_facilitators").val();
                var formData = $(formAddFacilitators).serializeArray();
                $.ajax({
                    url: '/adm/'+user_id+'/add/training/'+training_id+'/day/'+day_id+'/facilitators',
                    type: 'post',
                    data:formData,
                    success: function(response){
                        $("#modalUpdateSessionFacilitators").modal('hide');
                    }
                });
                return true;
            };
        });
        $("#modalUpdateSessionFacilitators").on("hidden.bs.modal",function (){
            location.reload();
        });
        $('#traineesList').DataTable();
    </script>
@endsection
