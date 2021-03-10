@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        {{--        <div class="page-header">--}}
        {{--            <div class="page-block">--}}
        {{--                <div class="row align-items-center">--}}
        {{--                    <div class="col-md-12">--}}
        {{--                        <ul class="breadcrumb">--}}
        {{--                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/templates')}}">Templates</a></li>--}}
        {{--                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/report/template/'.$template->id)}}">{{$template->name}}</a></li>--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal ">{{$report->name}}</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="{{"/adm/".$auth_admin->id."/submit/cms/report/".$report->id}}" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Reported By Name</label>
                                @if($auth_admin->role->name == "Center Manager")
                                    <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" value="{{$auth_admin->name}}" class="form-control" placeholder="Luke S" disabled>
                                @else
                                    <input type="text" name="name" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="Luke S" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Employee Number</label>
                                @if($auth_admin->role->name == "Center Manager")
                                    <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" value="{{$auth_admin->employee_number}}" placeholder="00198" disabled>
                                @else
                                    <input type="text" name="employee_number" style="border: none; border-bottom: 1px solid #000000;" class="form-control" placeholder="00198" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Report</label>
                                <input type="date" name="date" style="border: none; border-bottom: 1px solid #000000;" value="{{date("Y-m-d")}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <form action="#!">
                                <?php
                                $questions = $report->questions;
                                ?>
                                @if($questions)
                                    <div class="row">
{{--                                        <div class="col-md-2"></div>--}}
                                        @foreach($questions as $key=>$question)
                                            @if($question->question_type == "Open")
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{$question->question}}</label>
                                                        <input type="text" class="form-control" name="answer{{$question->id}}" placeholder="Your Answer">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($question->question_type == "Yes/No")
                                                <div class="col-md-12 yesNoQuest">
                                                    <div class="form-group">
                                                        <label>{{$question->question}}</label><br />
                                                        <input class="ml-4" name="radio{{$question->id}}" type="radio"> Yes <br />
                                                        <input class="ml-4" name="radio{{$question->id}}" type="radio"> No
                                                    </div>
                                                </div>
                                            @endif
                                            @if($question->question_type == "Dropdown")
                                                <div class="col-md-12">
                                                    <div class="form-group qOptions" id="qOptions{{$question->id}}" quiz_id="{{$question->id}}">
                                                        <label>{{$question->question}}</label>
                                                        <multiselect v-model="selectedOption" :options="options"
                                                                     placeholder="Select Your Answer" label="option" :track-by="trackBy"
                                                                     :searchable="true" :close-on-select="true">
                                                        </multiselect>
                                                        @if($auth_admin->role->name == "Center Manager")
                                                            <input type="hidden" v-for="option in selectedOption" name="option{{$question->id}}" :value="selectedOption.id">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($auth_admin->role->name == "Center Manager")
                                            <div class="col-md-12">
                                                <div class="form-group float-right">
                                                    <input type="button" class="btn btn-outline-info" value="Submit">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        let dropDownQuestions = $(".qOptions");
        let yesNoQuestions = $(".yesNoQuest");
        if (dropDownQuestions.length>1){
            for (i=0;i<dropDownQuestions.length;i++){
                let id = $(dropDownQuestions[i]).attr("id");
                new Vue({
                    el: "#"+id,
                    components: {
                        multiselect: window.VueMultiselect.default,
                        axios: window.axios.defaults,
                    },
                    data: function () {
                        return {
                            trackBy:"id",
                            selectedOption: [],
                            options: [],
                            initialValues: [],
                        }
                    },
                    methods:{
                        getAllOptions: function(){
                            axios
                                .get("/question/"+this.$el.attributes.quiz_id.value+"/options")
                                .then(response => {
                                    this.options = response.data;
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
                        this.getAllOptions();
                    },
                    // watch: {
                    //     options:{
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
            }
        }
        else{
            new Vue({
                el: ".qOptions",
                components: {
                    multiselect: window.VueMultiselect.default,
                    axios: window.axios.defaults,
                },
                data: function () {
                    return {
                        trackBy:"id",
                        selectedOption: [],
                        options: [],
                        initialValues: [],
                    }
                },
                methods:{
                    getAllOptions: function(){
                        axios
                            .get("/question/"+this.$el.attributes.quiz_id.value+"/options")
                            .then(response => {
                                this.options = response.data;
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
                    this.getAllOptions();
                },
                // watch: {
                //     options:{
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
        }
        if (yesNoQuestions.length>1){
            for (y=0;y<yesNoQuestions.length;y++){
                let id = $(yesNoQuestions[y]).attr("id");

            }
        }
    </script>
@endsection
