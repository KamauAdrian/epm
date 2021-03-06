@extends('Epm.layouts.master')

@section('content')

    {{--    @include('Epm.layouts.session-view')--}}
    <div class="col-md-12">
        <?php
        use App\Models\Center;$auth_admin = auth()->user();
        $session_date = date_create($training->start_date);
        $split_date = date_format($session_date,'l dS M Y');
        $days = $training->trainingDays;
        $center = $training->center;
        $trainers_raw = $training->trainers;
        $trainers = [];
        foreach ($trainers_raw as $trainer_raw){
            $trainers[] = $trainer_raw->name;
        }
        $classes_raw = $training->classes;
        $classes = [];
        foreach ($classes_raw as $class_raw){
            $classes[] = $class_raw->name;
        }
        $centers_raw = $training->centers;
        $centers = [];
        foreach ($centers_raw as $center_raw){
            $centers[] = $center_raw->name;
        }
//        $institutions_raw = $training->institutions;
//        $institutions = [];
//        foreach ($institutions_raw as $institution_raw){
//            $institutions[] = $institution_raw->name;
//        }
//        dd($trainers_raw);
//        dd($training->start_date,$training->end_date);

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
                                @if($training->venue == "Centers (AYECs)")
                                    <div class="col-md-3">
                                            <h6><span class="text-small" style="font-size: 14px">Centers</span></h6>
                                            @foreach($centers as $center)
                                                {{$center}}<br />
                                            @endforeach
                                            <a href="#!" data-toggle="modal" class="openModalAddCenter" data-training_id="{{$training->id}}"  id="openModalAddCenter}}" >
                                                <button type="button" title="Add Other Training Centers" class="btn btn-icon icon-s">
                                                    <i class="feather icon-plus"></i>
                                                </button>
                                            </a>
                                    </div>
                                @else
{{--                                    <div class="col-md-3">--}}
{{--                                        @if($institutions)--}}
{{--                                            <h6><span class="text-small" style="font-size: 14px">Institutions</span></h6>--}}
{{--                                            @foreach($institutions as $institution)--}}
{{--                                                {{$institution}}<br />--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            <h6><span class="text-small" style="font-size: 14px">Institutions</span></h6>--}}
{{--                                            <a href="#!">--}}
{{--                                                <button type="button" title="Choose Training Institution" class="btn btn-icon icon-s">--}}
{{--                                                    <i class="feather icon-plus"></i>--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
                                @endif
                                <div class="col-md-3">
                                    @if($classes)
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        @foreach($classes as $class)
                                            {{$class}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Add Classes To Training" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <h6><span class="text-small" style="font-size: 14px">Trainees</span></h6>
                                    <span class="mr-2"><i class="fa fa-user"></i> Male 20 </span> <span class="ml-2"><i class="fa fa-user"></i> Female 20</span><br />
                                    <span>Total 40</span>
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
                                    @if($classes)
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        @foreach($classes as $class)
                                            {{$class}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Add Classes To Training" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
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
                    <div class="modal fade" id="modalAddCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div style="display: none;" id="modal-modal-training-id"></div>
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="trainingCenters">
                                                        <label>Select Centers</label>
                                                        <multiselect v-model="selectedCenters" :options="centers"
                                                                     placeholder="Select Center" label="name" :track-by="trackBy"
                                                                     :searchable="true" :close-on-select="true" multiple>
                                                        </multiselect>
{{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                                            <input type="hidden" v-for="center in selectedCenters" name="centers[]" :value="center.id">
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
        let tCenters = new Vue({
            el: "#trainingCenters",
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data: function () {
                return {
                    trackBy:"id",
                    initialValues: [1,0,10],
                    selectedCenters: [],
                    centers:[
                        {id:0,name:"Adrian"},
                        {id:10,name:"Adrian 010"},
                        // oldCenters
                        // {"id":1,"name":"Test Center One","county":"Homa Bay","location":"HomaBay Post Office","location_lat_long":"-0.5298372,34.45709179999999","image":"icon_video.png","description":"This Center is So Cool","created_at":"2021-02-24T11:50:31.000000Z","updated_at":"2021-02-24T11:50:31.000000Z"}
                    ]
                }
            },
            methods:{
                getCenters: function(){
                    axios
                        .get('/centers')
                        .then(response => {
                            this.allCenters = response.data;
                            this.updateCenters();
                            console.log("centers json "+response.data);
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true);
                },
                updateCenters: function () {
                    let total = this.allCenters.length;
                    for (i=0;i<total;i++){
                        let all = this.centers.push(this.allCenters[i]);
                    }
                },
            },
            watch: {
                centers:{
                    created () {
                        this.getCenters();
                    },
                },
                initialValues: {
                    immediate: true,
                    handler(values) {
                        console.log("Found centers at this point "+this.centers.length);
                        console.log(values);
                        this.selectedCenters = this.centers.filter(r => values.includes(r[this.trackBy]));
                        // this.selectedCenters = centers[1];
                        // this.centers.filter(x => values.includes(x[this.trackBy]));
                    }
                }
            },
        });
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    trackBy: 'id',
                    initialValues: [9,13],
                    selectedPmo: null,
                    pmos: [],
                }
            },
            mounted () {
                this.getAssignees();
            },
            methods:{
                getAssignees(){
                    axios
                        .get('/list/collaborators/'+this.$el.attributes.project_id.value)
                        .then(response => {
                            this.pmos = response.data;
                        }).catch(error => {
                        console.log(error);
                        this.errored = true;
                    }).finally(() => this.loading = true);
                },
            },
            watch: {
                initialValues: {
                    immediate: true,
                    handler(values) {
                        this.selectedPmo = this.pmos.filter(x => values.includes(x[this.trackBy]));
                    }
                }
            },
        }).$mount('#collaborators');
        $('.openModalAddCenter').click(function(event){
            event.preventDefault();
            var taskId=$(this).attr("data-training_id");
            $("#modal-modal-training-id").text(taskId);
            $("#modalAddCenter").modal('show');
        });
    </script>
@endsection

