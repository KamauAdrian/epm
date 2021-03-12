@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Add New Trainee</h1>
                        </div>

                        <form class="my-5" method="post" action="{{url("/adm/".$auth_admin->id."/training/".$training->id."/day/".$day->id."/save/trainees")}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" id="gender">
                                        <label>Gender</label>
                                        <gender name="gender" v-model="selectedGender" :options="gender"
                                                placeholder="Select Gender"
                                                :searchable="true" :close-on-select="true">
                                        </gender>
                                        <input type="hidden" name="gender" :value="selectedGender">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Ex. luke@jacademy.org" value="{{old('email')}}">
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control" placeholder="0728909090" value="{{old('phone')}}">
                                        <span class="text-danger">{{$errors->first('phone')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ID Number</label>
                                        <input type="text" name="id_number" class="form-control" placeholder="36748285" value="{{old('id_number')}}">
                                        <span class="text-danger">{{$errors->first('id_number')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="number" name="age" class="form-control" placeholder="22" value="{{old('age')}}">
                                        <span class="text-danger">{{$errors->first('age')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="computer_literacy">
                                        <label>Level of Computer Literacy</label>
                                        <level name="level_of_computer_literacy" v-model="selectedLevel" :options="levels"
                                               placeholder="Search"
                                               :searchable="true" :close-on-select="true">
                                        </level>
                                        {{--                <input type="hidden" v-for="cm in selectedCm" name="team_leader_id" :value="selectedCm.id">--}}
                                        <input type="hidden" name="level_of_computer_literacy" :value="selectedLevel">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group" id="education">
                                        <label>Level of Education</label>
                                        <level name="level_of_education" v-model="selectedLevel" :options="levels"
                                               placeholder="Search"
                                               :searchable="true" :close-on-select="true">
                                        </level>
                                        {{--                <input type="hidden" v-for="cm in selectedCm" name="team_leader_id" :value="selectedCm.id">--}}
                                        <input type="hidden" name="level_of_education" :value="selectedLevel">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Field Of Study</label>
                                        <input type="text" name="field_of_study" class="form-control" placeholder="Computer Science" value="{{old('field_of_study')}}">
                                        <span class="text-danger">{{$errors->first('field_of_study')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Interests</label>
                                        <textarea name="interests" class="form-control" placeholder="Interests" value="{{old('interests')}}" cols="30" rows="5"></textarea>
                                        <span class="text-danger">{{$errors->first('interests')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-outline-info btn-block mb-3">Add Trainee</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js")
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
