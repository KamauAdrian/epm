@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Create New PMO Reporting Template</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/generate/pmo/report/template')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Report Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="ie Monthly Reporting">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="pmos">
                                        <label>Select PMO</label>
                                        <multiselect :options="pmos" v-model="selectedPmo"
                                                     placeholder="Search" label="name" track-by="id"
                                                     :searchable="true" :close-on-select="true"
                                                     multiple>
                                        </multiselect>
                                        <input type="hidden" name="pmo" v-for="pmo in selectedPmo"  :value="pmo.id">
                                        <span class="text-danger">{{$errors->first('pmo')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Report Questions</label>
                                    </div>
                                </div>
                                <div id="1" class="col-sm-12 addReportQuestion">
                                    <label>Select A Type of Question</label>
                                    <div class="form-group">
                                        <input type="radio" onclick="addOpenQuestion(1)" name="question_1_type" value="Open Question"> Open
                                        <input type="radio" onclick="addMultiChoiceQuestion(1)" name="question_1_type" value="Yes or No Question"> Yes or No
                                        <input type="radio" onclick="addSelectQuestion(1)" name="question_1_type" value="Dropdown Select Question"> Select (Dropdown with options)
                                    </div>
                                    <div class="form-group genQuiz" id="questionQuestion1" style="display: none;">
                                        <label>Question</label>
                                        <input type="text" name="question1" class="form-control" placeholder="Report question ie No of youths trained">
{{--                                        <span class="text-danger">{{$errors->first('questions')}}</span>--}}
                                    </div>
                                    <div class="form-group" id="optionsSelectQuestion1" style="display: none;">
                                        <label>Options</label>
                                        <div class="addOption1 mb-3">
                                            <input type="text" name="optionsQuestion1[]" class="form-control" placeholder="Add Option">
                                            {{--                                        <span class="text-danger">{{$errors->first('questions')}}</span>--}}
                                        </div>
                                        <a class="float-right" href="#!" style="color: #7E858E;" onclick="addNewOption(1)"><span><i class="fa fa-plus"></i></span> Add Another Option</a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="#!" style="color: #7E858E;" id="addNewQuestion"><span><i class="fa fa-plus"></i></span> Add Another Question</a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Create Template</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script type="text/javascript">
        // $(document).on("click", "#addNewQuestion", function(){});
        // document.getElementById('newReportQuestion').style.display='none';
        var id_question = 'questionQuestion';
        var id_option = 'optionsSelectQuestion';
        var i = 0;
        function addOpenQuestion(id){
            // var clicked = document.getElementById('open_question_type_'+id);
            // if (clicked.checked==true){}
                var quiz = document.getElementById('questionQuestion'+id);
                quiz.style.display = 'block'
                var option = document.getElementById('optionsSelectQuestion'+id);
                option.style.display = 'none'
        }
        function addMultiChoiceQuestion(id){
            // var clicked = document.getElementById('multi_question_type_'+id);
            // if (clicked.checked==true){}
                var quiz = document.getElementById('questionQuestion'+id);
                quiz.style.display = 'block'
                var option = document.getElementById('optionsSelectQuestion'+id);
                option.style.display = 'none'

        }
        function addSelectQuestion(id){
            // var clicked = document.getElementById('select_question_type_'+id);
                var quiz = document.getElementById('questionQuestion'+id);
                quiz.style.display = 'block'
                var option = document.getElementById('optionsSelectQuestion'+id);
                option.style.display = 'block'
        }
        function addNewOption(id){
            var option = $('.addOption'+id);
            option.last().after('<div class="addOption'+id+' mb-3">'+option.first().html()+'</div>');
        }
        var id = $(".addReportQuestion").last().attr("id");
        $(document).on("click", "#addNewQuestion", function(){
             id++;
            console.log(id);
            var newQuiz =
                '<div id="'+id+'" class="col-sm-12 addReportQuestion">' +
                '<label>Select A Type of Question</label> ' +
                '<div class="form-group"> ' +
                '<input type="radio" onclick="addOpenQuestion('+id+')" name="question_'+id+'_type" value="Open Question"> Open ' +
                '<input type="radio" onclick="addMultiChoiceQuestion('+id+')" name="question_'+id+'_type" value="Yes or No Question"> Yes or No ' +
                '<input type="radio" onclick="addSelectQuestion('+id+')" name="question_'+id+'_type" value="Dropdown Select Question"> Select (Dropdown with options) ' +
                '</div> ' +
                '<div class="form-group genQuiz" id="questionQuestion'+id+'" style="display: none;"> ' +
                '<label>Question</label> ' +
                '<input type="text" name="question'+id+'" class="form-control" placeholder="Report question ie No of youths trained">' +
                '</div> ' +
                '<div class="form-group" id="optionsSelectQuestion'+id+'" style="display: none;"> ' +
                '<label>Options</label> ' +
                '<div class="addOption'+id+' mb-3"> ' +
                '<input type="text" name="optionsQuestion'+id+'[]" class="form-control" placeholder="Add Option">' +
                '</div> ' +
                '<a class="float-right" href="#!" style="color: #7E858E;" onclick="addNewOption('+id+')">' +
                '<span><i class="fa fa-plus"></i></span> Add Another Option' +
                '</a> ' +
                '</div> ' +
                '</div>';
            // var oldQuiz = $('.addReportQuestion');
            // $(newQuiz).children(":nth-child(3)").attr('id',question_id+index);
            // $(newQuiz).children(":nth-child(4)").attr('id',option_id+index);
            // $(newQuiz).children(":nth-child(2)").children(":first").attr('onclick','addOpenQuestion('+question_id+index+','+option_id+index+')').attr('name','question_type_'+index);
            // $(newQuiz).children(":nth-child(2)").children(":nth-child(2)").attr("onclick",'addMultiChoiceQuestion('+question_id+index+','+option_id+index+')').attr('name','question_type_'+index);
            // $(newQuiz).children(":nth-child(2)").children(":nth-child(3)").attr("onclick",'addSelectQuestion('+question_id+index+','+option_id+index+')').attr('name','question_type_'+index);
            $(newQuiz).insertAfter(".addReportQuestion:last");
            // console.log(newQuiz);

        });


        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedPmo: null,
                    pmos: [],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/pmos')
                        .then(response => {
                            this.pmos = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#pmos')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection

{{--@section('new')--}}
{{--    <div class='input-form'>--}}
{{--        <input type='text' placeholder='Enter name' id='name_1' class='txt' >--}}
{{--        <input type='text' placeholder='Enter email' id='email_1' class='txt' >--}}
{{--    </div>--}}
{{--    <input type='button' id='but_add' value='Add new'>--}}


{{--<div style="display:none;" class="col-sm-12 addNewReportQuestion" id="newReportQuestion">--}}
{{--    <label>Select A Type of Question</label>--}}
{{--    <div class="form-group">--}}
{{--        <input type="radio" onclick="addOpenQuestion()" name="question_type_1" value="Open Question"> Open--}}
{{--        <span class="text-danger">{{$errors->first('questions')}}</span>--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <input type="radio" onclick="addMultiChoiceQuestion()" name="question_type_1" value="Open Question"> Yes or No--}}
{{--        <span class="text-danger">{{$errors->first('questions')}}</span>--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <input type="radio" onclick="addSelectQuestion()" name="question_type_1" value="Open Question"> Select--}}
{{--        <span class="text-danger">{{$errors->first('questions')}}</span>--}}
{{--    </div>--}}

{{--    <div class="form-group" id="questionQuestion" style="display: none;">--}}
{{--        <label>Question</label>--}}
{{--        <input type="text" name="questions[]" class="form-control" placeholder="Report question ie No of youths trained">--}}
{{--        <span class="text-danger">{{$errors->first('questions')}}</span>--}}
{{--    </div>--}}
{{--    <div class="form-group" id="choicesMultiChoiceQuestion" style="display: none;">--}}
{{--        <label>Choices</label>--}}
{{--        <div class="addChoice mb-3">--}}
{{--            <input type="text" name="questions[]" class="form-control" placeholder="Add Choice">--}}
{{--            <span class="text-danger">{{$errors->first('questions')}}</span>--}}
{{--        </div>--}}
{{--        <a class="float-right" href="#!" style="color: #7E858E;" onclick="addNewChoice()"><span><i class="fa fa-plus"></i></span> Add Another Choice</a>--}}
{{--    </div>--}}
{{--    <div class="form-group" id="optionsSelectQuestion" style="display: none;">--}}
{{--        <label>Options</label>--}}
{{--        <div class="addOption mb-3">--}}
{{--            <input type="text" name="questions[]" class="form-control" placeholder="Add Option">--}}
{{--            <span class="text-danger">{{$errors->first('questions')}}</span>--}}
{{--        </div>--}}
{{--        <a class="float-right" href="#!" style="color: #7E858E;" onclick="addNewOption()"><span><i class="fa fa-plus"></i></span> Add Another Option</a>--}}
{{--    </div>--}}
{{--</div>--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $('#but_add').click(function(){--}}
{{--                // Selecting last id--}}
{{--                var lastname_id = $('.input-form input[type=text]:nth-child(1)').last().attr('id');--}}
{{--                var split_id = lastname_id.split('_');--}}
{{--                // New index--}}
{{--                var index = Number(split_id[1]) + 1;--}}
{{--                // Create clone--}}
{{--                var newel = $('.input-form:last').clone(true);--}}
{{--                // Set id of new element--}}
{{--                $(newel).find('input[type=text]:nth-child(1)').attr("id","name_"+index);--}}
{{--                $(newel).find('input[type=text]:nth-child(2)').attr("id","email_"+index);--}}
{{--                // Set value--}}
{{--                $(newel).find('input[type=text]:nth-child(1)').val("name_"+index);--}}
{{--                $(newel).find('input[type=text]:nth-child(2)').val("email_"+index);--}}
{{--                // Insert element--}}
{{--                $(newel).insertAfter(".input-form:last");--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
