@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
                <div class="text-center">
                    <h1 class="f-w-400">Add a New Trainer</h1>
                </div>
                <form class="my-5" method="post" action="{{url('/save-trainer')}}" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label>Employee Number</label>
                                <input type="text" name="employee_number" class="form-control" placeholder="Luke S" value="{{old('employee_number')}}">
                                <span class="text-danger">{{$errors->first('employee_number')}}</span>
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
                                <input type="text" name="phone" class="form-control" placeholder="0728909090" value="{{old('phone')}}">
                                <span class="text-danger">{{$errors->first('phone')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" id="county">
                                <label>County</label>
                                <county name="county" v-model="selectedCounty" :options="counties"
                                        placeholder="Search"
                                        :searchable="true" :close-on-select="true">
                                </county>
                                {{--                <input type="hidden" v-for="cm in selectedCm" name="team_leader_id" :value="selectedCm.id">--}}
                                <input type="hidden" name="county" :value="selectedCounty">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><span><i class="mdi-maps-pin-drop bottom"></i></span>Location</label>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Limuru" value="{{old('location')}}">
                                <input type="hidden" id="event-location" name="event-location">
                                <span class="text-danger">{{$errors->first('location')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" id="gender">
                                <label>Gender</label>
                                <gender name="gender" v-model="selectedGender" :options="gender"
                                        placeholder="Select Gender"
                                        :searchable="true" :close-on-select="true">
                                </gender>
                                <input type="hidden" name="gender" :value="selectedGender">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" id="speciality">
                                <label>Speciality</label>
                                <category name="speciality" v-model="selectedCategory" :options="categories"
                                          placeholder="Search"
                                          :searchable="true" :close-on-select="true">
                                </category>
                                <input type="hidden" name="speciality" :value="selectedCategory">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}">
                                <span class="text-danger">{{$errors->first('start_date')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Office Supplies</label>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Contract</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" value="Yes" onclick="showInputSupplyContract()" class="form-check-input" id="office_yes_supplied_contract" name="office_supplies_contract">
                                            <label for="office_yes_supplied_contract" class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" value="No" onclick="hideInputSupplyContract()" class="form-check-input" id="office_no_supplied_contract" name="office_supplies_contract">
                                            <label for="office_no_supplied_contract" class="form-check-label">No</label>
                                        </div>
                                        <span class="text-danger">{{$errors->first('office_supplies_contract')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="supplies_contract" style="display: none">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Contract</label>
                                        <input type="file" name="contract" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Laptop</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" value="Yes" onclick="showInputSupplyLaptop()" class="form-check-input" id="office_yes_supplied_laptop" name="office_supplies_laptop">
                                            <label for="office_yes_supplied_laptop" class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" value="No" onclick="hideInputSupplyLaptop()" class="form-check-input" id="office_no_supplied_laptop" name="office_supplies_laptop">
                                            <label for="office_no_supplied_laptop" class="form-check-label">No</label>
                                        </div>
                                        <span class="text-danger">{{$errors->first('office_supplies_laptop')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="supplies_laptop" style="display: none">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Laptop Type</label>
                                        <input type="text" name="laptop_type" class="form-control" placeholder="Hp, Dell" value="{{old('laptop_type')}}">
                                        <span class="text-danger">{{$errors->first('laptop_type')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Laptop serial Number</label>
                                        <input type="text" name="laptop_serial_number" class="form-control" placeholder="5CG5350BTK" value="{{old('laptop_serial_number')}}">
                                        <span class="text-danger">{{$errors->first('laptop_serial_number')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Tag</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" value="Yes" class="form-check-input" name="office_supplies_tag">
                                            <label for="office_yes_supplied_tag" class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" value="No" class="form-check-input" name="office_supplies_tag">
                                            <label for="office_no_supplied_tag" class="form-check-label">No</label>
                                        </div>
                                        <span class="text-danger">{{$errors->first('office_supplies_tag')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Upload Profile Image</label>
                                <input type="file" name="image" class="form-control">
                                <span class="text-danger">{{$errors->first('image')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Add Bio</label>
                                <textarea name="bio" class="form-control" placeholder="Bio" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-outline-info btn-lg mb-3">Add Trainer</button>
                            </div>
                        </div>
                    </div>
                </form>

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
            console.log('this is the id :')
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions({'country': ['ke']});
            var chosenPlaceName="";
            var chosenLatLong="";
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                chosenPlaceName = place.name;
                chosenLatLong = place.geometry.location.lat() + ","+place.geometry.location.lng();
                document.getElementById('location').value = chosenPlaceName;
                document.getElementById('event-location').value = chosenLatLong;
                console.log(chosenLatLong);
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
            el: '#speciality',
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
        // console.log(document.getElementById('office_supplied')).value
        function showInputSupplyLaptop(){
            var yes = document.getElementById('office_yes_supplied_laptop');
            var laptop = document.getElementById('supplies_laptop');
            if (yes.checked==true){
                laptop.style.display='block';
            }
        }
        function hideInputSupplyLaptop(){
            var no = document.getElementById('office_no_supplied_laptop');
            var laptop = document.getElementById('supplies_laptop');
            if (no.checked==true){
                laptop.style.display='none';
            }
        }

        function showInputSupplyContract(){
            var yes = document.getElementById('office_yes_supplied_contract');
            var contract = document.getElementById('supplies_contract');
            if (yes.checked==true){
                contract.style.display='block';
            }
        }
        function hideInputSupplyContract(){
            var no = document.getElementById('office_no_supplied_contract');
            var contract = document.getElementById('supplies_contract');
            if (no.checked==true){
                contract.style.display='none';
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9yYsUxZxbbnwhBcyRnWhorWhNPuQYPus&libraries=places&callback=activatePlacesSearch"></script>
    {{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1htWBhqk0WQmip2LhO3leVvRzUg3T-o&libraries=places"></script>--}}
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
