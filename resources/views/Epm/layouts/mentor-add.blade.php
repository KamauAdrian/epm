<form class="my-5" method="post" action="{{url('/save-mentor')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="gender">
                <label>Gender</label>
                <gender v-model="selectedGender" :options="gender" name="gender"
                        placeholder="Select Gender"
                        :searchable="true" :close-on-select="true">
                </gender>
                <span class="text-danger">{{$errors->first('gender')}}</span>
                <input type="hidden"name="gender" :value="selectedGender">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="county">
                <label>County</label>
                <county v-model="selectedCounty" :options="counties" name="county"
                        placeholder="Select Gender"
                        :searchable="true" :close-on-select="true">
                </county>
                <span class="text-danger">{{$errors->first('county')}}</span>
                <input type="hidden" name="county" :value="selectedCounty">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label><span><i class="mdi-maps-pin-drop bottom"></i></span>Location</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Limuru" value="{{old('location')}}">
                <input type="hidden" id="event-location" name="location_lat_long">
                <span class="text-danger">{{$errors->first('location')}}</span>
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
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Add Mentor</button>
            </div>
        </div>
    </div>
</form>
