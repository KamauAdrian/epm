@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    $auth_admin = auth()->user();
    $trainers = $trainingDay->trainers;
    $classes = $trainingDay->classes;
    $sessions = $trainingDay->sessions;
    ?>
    <div class="col-md-12">
        <div class="row">
            @yield("sessionAllocations")
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
