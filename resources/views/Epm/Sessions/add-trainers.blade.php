@extends('Epm.layouts.form')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('form-desc')
    Add New Trainers To {{$session->name}}
@endsection

@section('form')
    @include('Epm.layouts.session-add-trainers')
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
                console.log('this is the session_id: '+this.$el.attributes.session_id.value)
                console.log('/new/session/trainers/'+this.$el.attributes.session_id.value)
                this.getTrainers()
                // this.getCms(this.cms)
            },
            methods:{
                getTrainers(){
                    axios
                        .get('/new/session/trainers/'+this.$el.attributes.session_id.value)
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
