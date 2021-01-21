@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
                <div class="text-center">
                    <h1 class="f-w-400">Add a New Project Manager</h1>
                </div>
                @include('Epm.layouts.pm-add')
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
    <script>
        new Vue({
            components: {
                gender: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedGender: null,
                    gender: [
                        'Male','Female',
                    ],
                }
            },
            methods:{
            },
        }).$mount('#gender')
        new Vue({
            components: {
                department: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedDepartment: null,
                    departments: [
                        'Training','Monitoring And Evaluation','Ajira Youth Empowerment','Centers (AYECs)','operations',
                        'Mentorship','Ajira Clubs','Program Management Office (PMO)',
                    ],
                }
            },
            methods:{
            },
        }).$mount('#department')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection