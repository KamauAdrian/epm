@extends('Epm.layouts.form')

@section('sidebar-nav')
    @include('Epm.SuAdmins.layouts.sidebar-nav')
@endsection

@section('header-nav')
    @include('Epm.SuAdmins.layouts.header-nav')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/dist/style.css')}}">
@endsection

@section('form-desc','Add a New Session')

@section('form')
@include('Epm.layouts.session-add')
@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
{{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedType: null,
                    type: [
                        'Private',
                        'Public',
                    ],
                }
            },
            methods:{
                getSessionType(){},
            },
        }).$mount('#session_type')
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedTrainer: null,
                    trainers: [],
                }
            },
            mounted () {
                this.getTrainers()
            },
            methods:{
                getTrainers(){
                    axios
                        .get('/trainers')
                        .then(response => {
                            this.trainers = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#trainers')
        function activatePlacesSearch() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions({'country': ['ke']});
            var chosenPlaceName="";
            var chosenLatLong="";
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                chosenPlaceName = place.name;
                chosenLatLong = place.geometry.location.lat() + ","+place.geometry.location.lng();
                document.getElementById('location').value = chosenPlaceName;
                document.getElementById('location_lat_long').value = chosenLatLong;
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9yYsUxZxbbnwhBcyRnWhorWhNPuQYPus&libraries=places&callback=activatePlacesSearch"></script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
