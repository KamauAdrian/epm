<form class="my-5" method="post" action="{{url('/save-trainer')}}">
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
                <gender name="gender" v-model="selectedGender" :options="gender"
                             placeholder="Select Gender"
                             :searchable="true" :close-on-select="true">
                </gender>
                <input type="hidden"name="gender" :value="selectedGender">
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
                <label>Upload Image</label>
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
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Add Trainer</button>
            </div>
        </div>
    </div>
</form>
