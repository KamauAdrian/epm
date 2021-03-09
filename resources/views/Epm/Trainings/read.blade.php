@extends('Epm.layouts.master')

@section('content')

    {{--    @include('Epm.layouts.session-view')--}}
    <div class="col-md-12">
        <?php
        use App\Models\Center;use App\Models\Cohort;use App\Models\Institution;$auth_admin = auth()->user();
        $session_date = date_create($training->start_date);
        $split_date = date_format($session_date,'l dS M Y');
        $days = $training->trainingDays;
        $center = $training->center;
        $trainers_raw = $training->trainers;
        $trainers = [];
        foreach ($trainers_raw as $trainer_raw){
            $trainers[] = $trainer_raw->name;
        }
        $cohort = Cohort::find($training->cohort_id);
        $center= Center::find($training->center_id);
        $institution = Institution::find($training->institution_id)
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Training</span></h6>
                                <p class="font-weight-normal">{{$training->training}}</p>
                            </div>
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Status</span></h6>
                                @if($training->status == 'Approved')
                                    <p style="font-size: 12px"><span class="badge badge-pill badge-light-dark">{{$training->status}}</span></p>
                                @elseif($training->status != 'Approved')
                                    <div class="btn-group">
                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle mb-2" data-toggle="dropdown">
                                            <span class="badge badge-pill badge-light-dark">{{$training->status}}</span>
                                            <span class = "caret"></span>
                                        </button>
                                        @if($auth_admin->role->name == 'Su Admin')
                                            <ul class = "dropdown-menu" role = "menu">
                                                <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/training/'.$training->id)}}">Approve Training</a></li>
                                            </ul>
                                        @endif
                                    </div>
                                @endif
                                {{--                            <p class="font-weight-normal">{{$trainingSession->status}}</p>--}}
                            </div>
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Description</span></h6>
                                <p class="font-weight-normal">{{$training->description}}</p>
                            </div>
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Scheduled Dates</span></h6>
                                <p class="font-weight-normal">Start: {{date('dS M Y',strtotime($training->start_date))}} <br /> End: {{date('dS M Y',strtotime($training->end_date))}}</p>
                            </div>
                            @if($training->training == "Physical" || $training->training == "TOT")
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body" style="height: 150px; overflow: auto;">
                                            <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                            @if($trainers)
                                                @foreach($trainers as $key=>$trainer)
                                                    {{$key+1}}.{{$trainer}}<br />
                                                @endforeach
                                                <a href="#!" data-toggle="modal" class="openModalUpdateTrainers mb-2 mr-3" style="position: absolute; right: 0; bottom: 0">
                                                    <button type="button" title="Add Trainers To Training" class="btn btn-icon icon-s">
                                                        <i class="feather icon-plus"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($training->venue == "Centers (AYECs)")
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="height: 150px; overflow: auto;">
                                                <h6><span class="text-small" style="font-size: 14px">Center</span></h6>
                                                @if($center)
                                                    {{$center->name}}
                                                @else
                                                    <a href="#!" data-toggle="modal" class="openModalUpdateCenter mb-2 mr-3" style="position: absolute; right: 0; bottom: 0">
                                                        <button type="button" title="Add Center" class="btn btn-icon icon-s">
                                                            <i class="feather icon-plus"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif($training->venue == "Institution (University/Tvet)")
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="height: 150px; overflow: auto;">
                                                <h6><span class="text-small" style="font-size: 14px">Institution</span></h6>
                                                @if($institution)
                                                    {{$institution->name}}
                                                @else
                                                    <a href="#!" data-toggle="modal" class="openModalUpdateInstitution mb-2 mr-3" style="position: absolute; right: 0; bottom: 0">
                                                        <button type="button" title="Add Institution" class="btn btn-icon icon-s">
                                                            <i class="feather icon-plus"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body" style="height: 150px; overflow: auto;">
                                            <h6><span class="text-small" style="font-size: 14px">Class/Cohort</span></h6>
                                            @if($cohort)

                                               <b>Category:</b> {{$cohort->category}} <br />
                                               <b>Cohort:</b> {{$cohort->name}}
                                            @else
                                                <a href="#!" data-toggle="modal" class="openModalUpdateCohort mb-2 mr-3" style="position: absolute; right: 0; bottom: 0">
                                                    <button type="button" title="Add Class/Cohort" class="btn btn-icon icon-s">
                                                        <i class="feather icon-plus"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body" style="height: 150px; overflow: auto;">
                                            <h6><span class="text-small" style="font-size: 14px">Trainees</span></h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <span>Male <br /> 20 </span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <span>Female <br /> 200</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    Total <br> 20
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($training->training == "Virtual")
                                <div class="col-md-6">
                                    @if($trainers)
                                        <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                        @foreach($trainers as $trainer)
                                            {{$trainer}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Choose Training Center" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if($cohort)
                                        <h6><span class="text-small" style="font-size: 14px">Class/Cohort</span></h6>
                                        {{$cohort}}<br />
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @if($training->training == "Physical")
                    @include("Epm.Trainings.Physical.index")
                @endif
                @if($training->training == "Virtual")
                    @include("Epm.Trainings.Virtual.index")
                @endif
                @if($training->training == "TOT")
                    @include("Epm.Trainings.TOT.index")
                @endif
                    <div class="modal fade" id="modalUpdateTrainers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form action="{{url("/adm/".$auth_admin->id."/update/training/".$training->id."/trainers")}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="trainingTrainers" training_id="{{$training->id}}">
                                                        <label>Select Trainers</label>
                                                        <multiselect v-model="selectedTrainers" :options="trainers"
                                                                     placeholder="Select Trainer" label="name" :track-by="trackBy"
                                                                     :searchable="true" :close-on-select="false" multiple>
                                                        </multiselect>
{{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                                            <input type="hidden" v-for="trainer in selectedTrainers" name="trainers[]" :value="trainer.id">
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
                    <div class="modal fade" id="modalUpdateCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form action="{{url("/adm/".$auth_admin->id."/update/training/".$training->id."/center")}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="trainingCenters">
                                                        <label>Select Center</label>
                                                        <multiselect v-model="selectedCenter" :options="centers"
                                                                     placeholder="Select Center" label="name" :track-by="trackBy"
                                                                     :searchable="true" :close-on-select="true">
                                                        </multiselect>
{{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                                            <input type="hidden" v-for="center in selectedCenter" name="center" :value="selectedCenter.id">
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
                    <div class="modal fade" id="modalUpdateInstitution" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form action="{{url("/adm/".$auth_admin->id."/update/training/".$training->id."/institution")}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="trainingInstitutions">
                                                        <label>Select Institution</label>
                                                        <multiselect v-model="selectedInstitution" :options="institutions"
                                                                     placeholder="Select Institution" label="name" :track-by="trackBy"
                                                                     :searchable="true" :close-on-select="true">
                                                        </multiselect>
{{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                                            <input type="hidden" v-for="institution in selectedInstitution" name="institution" :value="selectedInstitution.id">
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
                    <div class="modal fade" id="modalUpdateCohort" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form action="{{url("/adm/".$auth_admin->id."/update/training/".$training->id."/cohort")}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="cohorts">
                                                        <label>Select Class/Cohort</label>
                                                        <multiselect v-model="selectedCohort" :options="cohorts"
                                                                     placeholder="Select Class" label="cohort_name" :track-by="trackBy"
                                                                     :searchable="true" :close-on-select="true">
                                                        </multiselect>
{{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                                            <input type="hidden" v-for="cohort in selectedCohort" name="cohort" :value="selectedCohort.id">
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
        </div>
    </div>
@endsection
@section("js")
    <script>
        $('.openModalUpdateTrainers').click(function(event){
            event.preventDefault();
            $("#modalUpdateTrainers").modal('show');
        });
        $('.openModalUpdateCenter').click(function(event){
            event.preventDefault();
            $("#modalUpdateCenter").modal('show');
        });
        $('.openModalUpdateCohort').click(function(event){
            event.preventDefault();
            $("#modalUpdateCohort").modal('show');
        });
        $('.openModalUpdateInstitution').click(function(event){
            event.preventDefault();
            $("#modalUpdateInstitution").modal('show');
        });
        new Vue({
            el: "#trainingTrainers",
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data: function () {
                return {
                    trackBy:"id",
                    selectedTrainers: [],
                    trainers: [],
                    initialTrainers: [],
                }
            },
            methods:{
                getAllTrainers: function(){
                    axios
                        .get('/trainers')
                        .then(response => {
                            this.trainers = response.data;
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true);
                },
            },
            mounted () {
                this.getAllTrainers();
            },
            watch: {
                trainers:{
                    immediate: false,
                    handler(values){
                        axios.get("/training/"+this.$el.attributes.training_id.value+"/trainers").then(response => {this.initialTrainers = response.data;});
                    },
                },
                initialTrainers: {
                    immediate: false,
                    handler(values) {
                        this.selectedTrainers = this.trainers.filter(r => values.includes(r[this.trackBy]));
                    }
                }
            },
        });
        new Vue({
            el: "#trainingCenters",
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data: function () {
                return {
                    trackBy:"id",
                    selectedCenter: [],
                    centers: [],
                    // initialValues: [],
                }
            },
            methods:{
                getAllCenters: function(){
                    axios
                        .get('/centers')
                        .then(response => {
                            this.centers = response.data;
                            // this.allCenters = response.data;
                            // this.updateCenters();
                            // console.log("centers json "+response.data);
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true);
                },
                // updateCenters: function () {
                //     let total = this.allCenters.length;
                //     for (i=0;i<total;i++){
                //         let all = this.centers.push(this.allCenters[i]);
                //     }
                // },
            },
            mounted () {
                this.getAllCenters();
            },
            // watch: {
            //     centers:{
            //         immediate: false,
            //         handler(values){
            //             axios.get("/training/"+this.$el.attributes.training_id.value+"/centers").then(response => {this.initialValues = response.data;});
            //         },
            //     },
            //     initialValues: {
            //         immediate: true,
            //         handler(values) {
            //             this.selectedCenters = this.centers.filter(r => values.includes(r[this.trackBy]));
            //         }
            //     }
            // },
        });
        new Vue({
            el: "#trainingInstitutions",
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data: function () {
                return {
                    trackBy:"id",
                    selectedInstitution: [],
                    institutions: [],
                    // initialValues: [],
                }
            },
            methods:{
                getAllInstitutions: function(){
                    axios
                        .get('/institutions')
                        .then(response => {
                            this.institutions = response.data;
                            // this.allCenters = response.data;
                            // this.updateCenters();
                            // console.log("centers json "+response.data);
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true);
                },
                // updateCenters: function () {
                //     let total = this.allCenters.length;
                //     for (i=0;i<total;i++){
                //         let all = this.centers.push(this.allCenters[i]);
                //     }
                // },
            },
            mounted () {
                this.getAllInstitutions();
            },
            // watch: {
            //     institutions:{
            //         immediate: false,
            //         handler(values){
            //             axios.get("/training/"+this.$el.attributes.training_id.value+"/institutions").then(response => {this.initialValues = response.data;});
            //         },
            //     },
            //     initialValues: {
            //         immediate: true,
            //         handler(values) {
            //             this.selectedInstitutions = this.institutions.filter(r => values.includes(r[this.trackBy]));
            //         }
            //     }
            // },
        });
        new Vue({
            el: "#cohorts",
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data: function () {
                return {
                    trackBy:"id",
                    selectedCohort: [],
                    cohorts: [],
                    // initialValues: [],
                }
            },
            methods:{
                getAllCohorts: function(){
                    axios
                        .get('/cohorts')
                        .then(response => {
                            this.cohorts = response.data;
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
                this.getAllCohorts();
            },
            // watch: {
            //     cohorts:{
            //         immediate: false,
            //         handler(values){
            //             axios.get("/training/"+this.$el.attributes.training_id.value+"/cohorts").then(response => {this.initialValues = response.data;});
            //         },
            //     },
            //     initialValues: {
            //         immediate: true,
            //         handler(values) {
            //             this.selectedCohorts = this.cohorts.filter(r => values.includes(r[this.trackBy]));
            //         }
            //     }
            // },
        });
    </script>
@endsection

