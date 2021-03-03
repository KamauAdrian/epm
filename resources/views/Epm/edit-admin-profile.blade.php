@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    @include('Epm.layouts.adm-profile-edit')
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
                    selectedCenter: null,
                    centers: [],
                }
            },mounted(){
                this.getCenters();
            },
            methods:{
                getCenters(){
                    axios
                        .get('/centers')
                        .then(response => {
                            this.centers = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#center')

        new Vue({
            components: {
                gender: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedGender: this.saved_gender(),
                    gender: [
                        'Male','Female',
                    ],
                }
            },
            methods:{
                saved_gender(){
                    return document.getElementById('saved_gender').value
                }
            },
        }).$mount('#gender')
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
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCounty: this.getCounty(),
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
                getCounty(){
                    return document.getElementById('selected_county').value
                },
            },
        }).$mount('#county')
        new Vue({
            components: {
                department: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedDepartment: this.saved_department(),
                    departments: [
                        'Ajira Clubs','Ajira Youth Empowerment Centers (AYECs)','Mentorship','Monitoring And Evaluation','Operations',
                        'Program Management Office (PMO)','Training'
                    ],
                }
            },
            methods:{
                saved_department(){
                    return document.getElementById('saved_department').value
                }
            },
        }).$mount('#department')
        new Vue({
            el: '#speciality',
            components: {
                speciality: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCategory: this.saved_speciality(),
                    categories: [
                        'Data Management','Digital Marketing','Transcription',
                        'Writing and Translation','Virtual Assistant'
                    ],
                }
            },
            methods:{
                saved_speciality(){
                    return document.getElementById('saved_speciality').value
                }
            },
        })
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9yYsUxZxbbnwhBcyRnWhorWhNPuQYPus&libraries=places&callback=activatePlacesSearch"></script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
