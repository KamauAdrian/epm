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
                            <h1 class="f-w-400">Add Trainee to Session</h1>
                        </div>
                        @include('Epm.layouts.trainees-add')
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
    <script>
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
        // google.maps.event.addDomListener(window, 'load', initialize);

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
                county: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCounty: null,
                    counties: [
                        'Baringo','Bomet','Bungoma','Busia','Elgeyo Marakwet','Embu','Garissa','Homa Bay', 'Kajiado',
                        'Kakamega','Kericho','Kiambu','Kilifi','Kirinyaga','Kisii','Kisumu','Kitui','Kwale', 'Laikipia',
                        'Lamu','Machakos','Makueni','Mandera','Meru','Migori','Marsabit','Muranga','Nairobi','Nakuru','Nandi',
                        'Narok','Nyamira','Nyandarua','Nyeri','Samburu','Siaya','Taita Taveta','Tana River','Tharaka Nithi',
                        'Trans Nzoia','Turkana','Uasin Gishu','Vihiga','Wajir','West Pokot'
                    ],
                }
            },
            methods:{
            },
        }).$mount('#county')
        new Vue({
            components: {
                category: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCategory: null,
                    categories: [
                        'Data Management','Digital Marketing','Transcription',
                        'Writing and Translation','Virtual Assistant'
                    ],
                }
            },
            methods:{
            },
        }).$mount('#category')

        new Vue({
            components: {
                level: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedLevel: null,
                    levels: [
                        'Beginner','Intermediate','Proficient'
                    ],
                }
            },
            methods:{
            },
        }).$mount('#computer_literacy')

        new Vue({
            components: {
                level: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedLevel: null,
                    levels: [
                        'Primary Level','Secondary Level','Tertiary Level'
                    ],
                }
            },
            methods:{
            },
        }).$mount('#education')
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9yYsUxZxbbnwhBcyRnWhorWhNPuQYPus&libraries=places&callback=activatePlacesSearch"></script>

    {{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1htWBhqk0WQmip2LhO3leVvRzUg3T-o&libraries=places"></script>--}}

    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
