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
                        @include('Epm.layouts.session-add')
{{--                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/session')}}">--}}
{{--                            @csrf--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <div class="form-group" id="training">--}}
{{--                                        <label>SELECT TRAINING</label>--}}
{{--                                        <multiselect v-model="selectedTraining" :options="trainings"--}}
{{--                                                  placeholder="Select Training"--}}
{{--                                                  :searchable="true" :close-on-select="true">--}}
{{--                                        </multiselect>--}}
{{--                                        <input type="hidden" name="training" :value="selectedTraining">--}}
{{--                                        <span class="text-danger">{{$errors->first('training')}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>TRAINING START DATE</label>--}}
{{--                                        <input type="date" name="start_date" class="form-control" id="sessionStartDate" value="{{old('start_date')}}">--}}
{{--                                        <span class="text-danger">{{$errors->first('start_date')}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>TRAINING END DATE</label>--}}
{{--                                        <input type="date" name="end_date" class="form-control" id="sessionEndDate" value="{{old('end_date')}}">--}}
{{--                                        <span class="text-danger">{{$errors->first('end_date')}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @if($trainers!='')--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="form-group" id="trainers">--}}
{{--                                            <label>SELECT TRAINERS</label>--}}
{{--                                            <multiselect :options="trainers" v-model="selectedTrainer"--}}
{{--                                                         placeholder="Select Session Trainers" label="name" track-by="id"--}}
{{--                                                         :searchable="true" :close-on-select="true"--}}
{{--                                                         multiple>--}}
{{--                                            </multiselect>--}}
{{--                                            <input type="hidden" name="trainers[]" v-for="trainer in selectedTrainer"  :value="trainer.id">--}}
{{--                                            <span class="text-danger">{{$errors->first('trainers[]')}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <div class="form-group" id="trainingType">--}}
{{--                                        <label>TRAINING TYPE</label>--}}
{{--                                        <multiselect v-model="selectedTraining" :options="trainings"--}}
{{--                                                     placeholder="Select Training"--}}
{{--                                                     :searchable="true" :close-on-select="true">--}}
{{--                                        </multiselect>--}}
{{--                                        <input type="hidden" name="training" :value="selectedTraining">--}}
{{--                                        <span class="text-danger">{{$errors->first('training')}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>TRAINING DESCRIPTION</label>--}}
{{--                                        <textarea name="about" class="form-control" placeholder="Short Session Description" cols="30" rows="5">{{old('about')}}</textarea>--}}
{{--                                        <span class="text-danger">{{$errors->first('about')}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-12">--}}
{{--                                        <div class="form-group float-right">--}}
{{--                                            <button type="submit" class="btn btn-outline-info float-right">Add Session</button>--}}
{{--                                        </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        var start_date = '';
        var end_date = '';
        $("#sessionStartDate").change(function (){
            start_date = $("#sessionStartDate").val();
            console.log(start_date);
        });
        $("#sessionEndDate").change(function (){
            end_date = $("#sessionEndDate").val();
            console.log(end_date,end_date-start_date);
        });
        console.log(start_date,end_date);
        function sessionModePhysical(){
            document.getElementById('sessionMode').style.display='block';
            document.getElementById('session_type').style.display='none';
            document.getElementById('sessionLink').style.display='none';
        }
        function sessionModeVirtual(){
            document.getElementById('sessionMode').style.display='none';
            document.getElementById('session_type').style.display='block';
            document.getElementById('sessionLink').style.display='block';
        }

        function generateSessionLink(){
            document.getElementById('sessionGoogleMeetLink').disabled= true;
        }

        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedTraining: [],
                    trainings: [
                        'Physical',
                        'Virtual',
                        'TOT',
                    ],
                }
            },
        }).$mount('#training')

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
        }).$mount('#trainingType')

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
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedSessionClass: null,
                    session_classes: [],
                }
            },
            mounted () {
                this.getClasses()
            },
            methods:{
                getClasses(){
                    axios
                        .get('/session/classes')
                        .then(response => {
                            this.session_classes = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#sessionClasses')
        new Vue({
            el: '#category',
            components: {
                category: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCategory: null,
                    categories: [
                        'Data Entry/Management','Virtual Assistant','Transcription',
                        'Digital Marketing/Ecommerce','Content Writing and Translation', 'All Categories'
                    ],
                }
            },
            methods:{
            },
        })
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
