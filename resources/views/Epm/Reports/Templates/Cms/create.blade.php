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
                            <h1 class="f-w-400">Create New Reporting Template</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/generate/cms/report/template')}}">
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
                                    <div class="form-group">
                                        <label>Report Questions</label>
                                    </div>
                                </div>
                                <div id="1" class="col-sm-12 addReportQuestion">
                                    <label>Select A Type of Question</label>
                                    <div class="form-group">
                                        <input type="radio" onclick="addOpenQuestion(1)" name="question_1_type" value="Open"> Open
                                        <input type="radio" onclick="addMultiChoiceQuestion(1)" name="question_1_type" value="Yes/No"> Yes or No
                                        <input type="radio" onclick="addSelectQuestion(1)" name="question_1_type" value="Dropdown"> Select (Dropdown with options)
                                    </div>
                                    <div class="form-group genQuiz" id="questionQuestion1" style="display: none;">
                                        <label>Question</label>
                                        <input type="text" name="questions[]" class="form-control" placeholder="Report question ie No of youths trained">
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
                '<input type="radio" onclick="addOpenQuestion('+id+')" name="question_'+id+'_type" value="Open"> Open ' +
                '<input type="radio" onclick="addMultiChoiceQuestion('+id+')" name="question_'+id+'_type" value="Yes/No"> Yes or No ' +
                '<input type="radio" onclick="addSelectQuestion('+id+')" name="question_'+id+'_type" value="Dropdown"> Select (Dropdown with options) ' +
                '</div> ' +
                '<div class="form-group genQuiz" id="questionQuestion'+id+'" style="display: none;"> ' +
                '<label>Question</label> ' +
                '<input type="text" name="questions[]" class="form-control" placeholder="Report question ie No of youths trained">' +
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
            $(newQuiz).insertAfter(".addReportQuestion:last");
        });
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
