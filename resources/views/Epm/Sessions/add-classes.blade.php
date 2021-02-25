@extends('Epm.layouts.form')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('form-desc')
    Add New Classes To {{$session->name}}
@endsection

@section('form')

{{--    @include('Epm.layouts.session-add-trainers')--}}

<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/session/'.$session->id.'/day/'.$trainingDay->id.'/save/trainers')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div day_id="{{$trainingDay->id}}" class="form-group" id="new_session_trainers">
                <label>Select Class</label>
                <multiselect name="cms" v-model="selectedTrainer" :options="trainers"
                             placeholder="Search" label="name" track-by="id"
                             :searchable="true" :close-on-select="true" multiple>
                </multiselect>
                <input type="hidden" v-for="member in selectedTrainer" name="new_session_trainers_ids[]" :value="member.id">
                <input type="hidden" v-for="member in selectedTrainer" name="new_session_trainers_names[]" :value="member.name">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-info btn-block mb-3">Add Trainers</button>
            </div>
        </div>
        {{--        <input type="hidden" name="trainer_team_id" value="{{$team->id}}">--}}
    </div>

</form>


@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedTrainer: null,
                    trainers: [],
                }
            },
            mounted () {
                console.log('this is the session_id: '+this.$el.attributes.day_id.value)
                console.log('/new/session/trainers/'+this.$el.attributes.day_id.value)
                this.getTrainers()
                // this.getCms(this.cms)
            },
            methods:{
                getTrainers(){
                    axios
                        .get('/new/session/classes/'+this.$el.attributes.day_id.value)
                        .then(response => {
                            this.trainers = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                }
            },
        }).$mount('#new_session_trainers')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
