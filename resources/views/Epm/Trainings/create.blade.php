@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/dist/style.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Add a New Training</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        {{--                        @include('Epm.layouts.session-add')--}}
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/training')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" id="training">
                                        <label>SELECT TRAINING</label>
                                        <multiselect id="multiSelectTraining" v-model="selectedTraining" :options="trainings"
                                                     placeholder="Select Training" @close="alertClosed"
                                                     :searchable="true" :close-on-select="true">
                                        </multiselect>
{{--                                        <pre>{{$data }}</pre>--}}
                                        <input type="hidden" id="selected_training" name="training" :value="selectedTraining">
                                        <span class="text-danger">{{$errors->first('training')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="trainingVenue" style="display: none;">
                                        <label>TRAINING VENUE</label>
                                        <multiselect v-model="selectedVenue" :options="venues"
                                                     placeholder="Select Venue" @close="alertClosed"
                                                     :searchable="true" :close-on-select="true">
                                        </multiselect>
                                        <input type="hidden" name="venue" :value="selectedVenue">
                                        <span class="text-danger">{{$errors->first('venue')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="trainingVenueCenter" style="display: none;">
                                        <label>CENTER</label>
                                        <multiselect v-model="selectedCenters" :options="centers"
                                                     placeholder="Select Center" track-by="id" label="name"
                                                     :searchable="true" :close-on-select="true" multiple>
                                        </multiselect>
                                        <input type="hidden" v-for="center in selectedCenters" name="centers[]" :value="center.id">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="trainingVenueInstitution" style="display: none;">
                                        <label>INSTITUTION</label>
                                        <multiselect v-model="selectedInstitutions" :options="institutions"
                                                     placeholder="Select Institution" track-by="id" label="name"
                                                     :searchable="true" :close-on-select="true" multiple>
                                        </multiselect>
                                        <input type="hidden" v-for="institution in selectedInstitutions" name="institutions[]" :value="institution.id">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="trainingType">
                                        <label>PUBLIC/PRIVATE</label>
                                        <multiselect v-model="selectedTraining" :options="trainings"
                                                     placeholder="Public/Private"
                                                     :searchable="true" :close-on-select="true">
                                        </multiselect>
                                        <input type="hidden" name="type" :value="selectedTraining">
                                        <span class="text-danger">{{$errors->first('type')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>TRAINING START DATE</label>
                                        <input type="date" name="start_date" class="form-control" id="sessionStartDate" value="{{old('start_date')}}">
                                        <span class="text-danger">{{$errors->first('start_date')}}</span>
                                    </div>
                                </div>
                                @if($trainers!='')
                                    <div class="col-sm-12">
                                        <div class="form-group" id="trainingTrainers">
                                            <label>SELECT TRAINERS</label>
                                            <Multiselect :options="trainers" v-model="selectedTrainer"
                                                         placeholder="Select Trainers" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true"
                                                         multiple>
                                            </Multiselect>
                                            <input type="hidden" name="trainers[]" v-for="trainer in selectedTrainer"  :value="trainer.id">
                                            <span class="text-danger">{{$errors->first('trainers[]')}}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>TRAINING DESCRIPTION</label>
                                        <textarea name="about" class="form-control" placeholder="Short Training Description" cols="30" rows="5">{{old('about')}}</textarea>
                                        <span class="text-danger">{{$errors->first('about')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-info float-right">Add Training</button>
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
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        function generateSessionLink(){
            document.getElementById('sessionGoogleMeetLink').disabled= true;
        }
        new Vue({
            el: "#training",
            components: {
                Multiselect: window.VueMultiselect.default,
            },
            data:{
                selectedTraining: [],
                trainings: [
                    'Physical',
                    'Virtual',
                    'TOT',
                ],
            },
            methods:{
                alertClosed:function(){
                    var opselected = this.selectedTraining;
                    var centerInstitution = document.getElementById("trainingVenue");
                    if(opselected=="Physical" || opselected=="TOT"){
                        centerInstitution.style.display="block";
                    }
                    if(opselected=="Virtual"){
                        centerInstitution.style.display="none";
                    }
                },
            },
        });
        new Vue({
            el: "#trainingVenue",
            components: {
                multiselect: window.VueMultiselect.default,
            },
            data:{
                selectedVenue: [],
                venues: [
                    'Centers (AYECs)',
                    'Institution (University/Tvet)',
                ],
            },
            methods:{
                alertClosed:function(){
                    var opselected = this.selectedVenue;
                    var venueCenter = document.getElementById("trainingVenueCenter");
                    var venueInstitution = document.getElementById("trainingVenueInstitution");
                    if(opselected=="Centers (AYECs)"){
                        venueCenter.style.display="block";
                        venueInstitution.style.display="none";
                    }
                    if(opselected=="Institution (University/Tvet)"){
                        venueCenter.style.display="none";
                        venueInstitution.style.display="block";
                    }
                },
            },
        });

        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedTraining: [],
                    trainings: [
                        'Public',
                        'Private',
                    ],
                }
            },
        }).$mount('#trainingType');

        new Vue({
            el: "#trainingVenueCenter",
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data:{
                selectedCenters: null,
                centers: [],
            },
            mounted () {
                this.getCenters()
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
        });
        new Vue({
            el: "#trainingVenueInstitution",
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data:{
                selectedInstitutions: null,
                institutions: [
                    {id:1,name:'Africa Nazarene University'},
                    {id:2,name:'Chuka University'},
                    {id:3,name:'Daystar University'},
                    {id:4,name:'Dedan Kimathi University of Technology'},
                    {id:5,name:'Egerton University'},
                    {id:5,name:'Gretsa University'},
                    {id:5,name:'Jomo Kenyatta University of Agriculture and Technology'},
                ],
            },
            methods:{

            },
        });
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
        }).$mount('#trainingTrainers');
        // new Vue({
        //     components: {
        //         Multiselect: window.VueMultiselect.default,
        //         axios: window.axios.defaults,
        //     },
        //     data() {
        //         return {
        //             selectedSessionClass: null,
        //             session_classes: [],
        //         }
        //     },
        //     mounted () {
        //         this.getClasses()
        //     },
        //     methods:{
        //         getClasses(){
        //             axios
        //                 .get('/session/classes')
        //                 .then(response => {
        //                     this.session_classes = response.data
        //                 })
        //                 .catch(error => {
        //                     console.log(error)
        //                     this.errored = true
        //                 })
        //                 .finally(() => this.loading = true)
        //         },
        //     },
        // }).$mount('#sessionClasses');
        // new Vue({
        //     el: '#category',
        //     components: {
        //         category: window.VueMultiselect.default,
        //     },
        //     data() {
        //         return {
        //             selectedCategory: null,
        //             categories: [
        //                 'Data Entry/Management','Virtual Assistant','Transcription',
        //                 'Digital Marketing/Ecommerce','Content Writing and Translation', 'All Categories'
        //             ],
        //         }
        //     },
        //     methods:{
        //     },
        // });
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
