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
                            <h1 class="f-w-400">Add a New Session</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/session')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>SESSION NAME</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="category">
                                        <label>SESSION CATEGORY</label>
                                        <category v-model="selectedCategory" :options="categories"
                                                  placeholder="Select The Session Category"
                                                  :searchable="true" :close-on-select="true">
                                        </category>
                                        <input type="hidden" name="category" :value="selectedCategory">
                                        <span class="text-danger">{{$errors->first('category')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>SESSION ABOUT</label>
                                        <textarea name="about" class="form-control" placeholder="Short Session Description" cols="30" rows="5">{{old('about')}}</textarea>
                                        <span class="text-danger">{{$errors->first('about')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>SESSION TYPE</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 ml-4">
                                            <div class="form-group">
                                                <input type="radio" name="type" onclick="sessionModePhysical()" value="Physical"> Physical
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="type" onclick="sessionModeVirtual()" value="Virtual"> Virtual
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" name="type" onclick="sessionModeTot()" value="TOT"> TOT
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-danger">{{$errors->first('type')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SESSION START DATE</label>
                                        <input type="date" name="start_date" class="form-control" id="sessionStartDate" value="{{old('start_date')}}">
                                        <span class="text-danger">{{$errors->first('start_date')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SESSION END DATE</label>
                                        <input type="date" name="end_date" class="form-control" id="sessionEndDate" value="{{old('end_date')}}">
                                        <span class="text-danger">{{$errors->first('end_date')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="sessionMode" style="display: none">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group" id="county">
                                                <label>County</label>
                                                <county name="county" v-model="selectedCounty" :options="counties"
                                                        placeholder="Search"
                                                        :searchable="true" :close-on-select="true">
                                                </county>
                                                <input type="hidden" name="county" :value="selectedCounty">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>TOWN/LOCATION</label>
                                                <input type="text" id="location" name="location" class="form-control" value="{{old('location')}}">
                                                <input type="hidden" name="location_lat_long" id="location_lat_long">
                                                <span class="text-danger">{{$errors->first('location')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>INSTITUTION</label>
                                                <input type="text" name="institution" class="form-control" placeholder="Institution" value="{{old('institution')}}">
                                                <span class="text-danger">{{$errors->first('institution')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="session_type" style="display: none">
                                        <label>SESSION TYPE</label>
                                        <multiselect :options="types" v-model="selectedType"
                                                     placeholder="Select Session Type"
                                                     :searchable="true" :close-on-select="true">
                                        </multiselect>
                                        <input type="hidden" name="type" :value="selectedType">
                                        <span class="text-danger">{{$errors->first('type')}}</span>
                                    </div>
                                </div>
                                @if($trainers!='')
                                    <div class="col-sm-12">
                                        <div class="form-group" id="trainers">
                                            <label>SESSION TRAINERS</label>
                                            <multiselect :options="trainers" v-model="selectedTrainer"
                                                         placeholder="Select Session Trainers" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true"
                                                         multiple>
                                            </multiselect>
                                            <input type="hidden" name="trainers[]" v-for="trainer in selectedTrainer"  :value="trainer.id">
                                            <span class="text-danger">{{$errors->first('trainers[]')}}</span>
                                        </div>
                                    </div>
                                @endif
                                @if($classes!='')
                                    <div class="col-sm-12">
                                        <div class="form-group" id="sessionClasses">
                                            <label>SESSION TARGET CLASS</label>
                                            <multiselect :options="session_classes" v-model="selectedSessionClass"
                                                         placeholder="Select Session Target Class" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true" multiple>
                                            </multiselect>
                                            <input type="hidden" name="s_classes[]" v-for="sclass in selectedSessionClass"  :value="sclass.id">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group" id="sessionLink" style="display: none">
                                                <a href="#!">
                                                    <button type="button" id="sessionGoogleMeetLink" onclick="generateSessionLink()" class="btn btn-outline-info">Generate Google Meet Link</button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-info float-right">Add Session</button>
                                            </div>
                                        </div>
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
            },
            data() {
                return {
                    selectedType: null,
                    types: [
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
                        'Digital Marketing/Ecommerce','Content Writing and Translation'
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
