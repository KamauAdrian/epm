<form class="my-5" method="post" action="{{url('/save-cm')}}">
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
            <div class="form-group" id="center">
                <label>Center</label>
                <multiselect name="center" v-model="selectedCenter" :options="centers"
                             placeholder="Select Center" label="name" track-by="id"
                             :searchable="true" :close-on-select="true">
                </multiselect>
                <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">
{{--                <input type="hidden" v-for="center in selectedCenter" name="center_name" :value="selectedCenter.name">--}}
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
                <span class="text-danger">{{$errors->first('gender')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="county">
                <label>County</label>
                <county name="county" v-model="selectedCounty" :options="counties"
                             placeholder="Search"
                             :searchable="true" :close-on-select="true">
                </county>
                <input type="hidden" name="county" :value="selectedCounty">
                <span class="text-danger">{{$errors->first('county')}}</span>
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
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Add Center Manager</button>
            </div>
        </div>
    </div>
</form>
