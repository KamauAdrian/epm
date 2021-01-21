@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 100px; padding-right: 100px">
                <div class="text-center">
                    <h1 class="f-w-400">{{$report->name}}</h1>
                </div>
                @include('Epm.layouts.Reports.submit-report')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        // function addActivity(){
        //     var myTr = document.getElementById('addNewActivity');
        //     var length = myTr.getAttribute('length');
        //     var tdx = document.createElement('td');
        //     var inputx = document.createElement('input');
        //     inputx.setAttribute('type','text');
        //     inputx.setAttribute('name','activity');
        //     inputx.setAttribute('required','required');
        //     inputx.style.border = 'none';
        //     tdx.appendChild(inputx);
        //     var tdy = document.createElement('td');
        //     var inputy = document.createElement('input');
        //     inputy.setAttribute('type','text');
        //     inputy.setAttribute('name','reports_quest');
        //     inputy.setAttribute('required','required');
        //     inputy.style.border = 'none';
        //     // tdy.appendChild(inputy);
        //     for ($i=0;$i<length;$i++){
        //         tdy.appendChild(inputy);
        //     }
        //     console.log(tdy);
        //     myTr.append(tdx,tdy);
        // }


// console.log(document.getElementById('addNewActivity'));
// function myAddActivityFunction(){
//     var activity = document.getElementById('addNewActivity');
//
// }

            var i = 0;
            $(document).on("click", "#addActivity", function(){
                i++
                console.log(i);
                var activity = $('.addNewActivity');
                console.log(activity);
                activity.last().after('<tr class="addNewActivity">'+activity.first().html()+'</tr>');
            });

        $(document).on("click", "#addNewQuestion", function(){
            var question = $('.addReportQuestion');
            question.last().after('<div class="col-sm-12 addReportQuestion">'+question.first().html()+'</div><br />');
        });
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
